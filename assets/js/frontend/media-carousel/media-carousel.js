(function ($) {
  "use strict";

  var DEBUG = false;
  function dlog() {
    if (!DEBUG) return;
    try {
      console.log.apply(console, arguments);
    } catch (e) {}
  }

  dlog("media-carousel.js loaded (smooth-version)");

  var MediaCarouselHandler = elementorModules.frontend.handlers.Base.extend({
    getDefaultSettings: function () {
      return {
        selectors: {
          mainSwiper: ".elementor-main-swiper, .rael-main-swiper",
          swiperSlide: ".swiper-slide",
        },
        slidesPerView: {
          desktop: 3,
          tablet: 2,
          mobile: 1,
        },
      };
    },

    getDefaultElements: function () {
      var selectors = this.getSettings("selectors");
      return {
        $mainSwiper: this.$element.find(selectors.mainSwiper),
      };
    },

    getSpaceBetween: function (device) {
      var key =
        "rael_space_between" +
        (device && device !== "desktop" ? "_" + device : "");
      var setting = this.getElementSettings(key);
      var val =
        typeof setting === "object" && setting !== null && "size" in setting
          ? parseInt(setting.size, 10)
          : parseInt(setting, 10);
      return isNaN(val) ? 0 : val;
    },

    getSlidesPerView: function (device) {
      var key =
        "rael_slides_per_view" +
        (device && device !== "desktop" ? "_" + device : "");
      var raw = this.getElementSettings(key);
      var val =
        typeof raw === "object" && raw !== null && "size" in raw
          ? raw.size
          : parseInt(raw, 10);

      if (!isNaN(val) && val > 0) return val;
      var fallback = this.getSettings("slidesPerView")[device] || 1;
      return fallback;
    },

    getSwiperOptions: function () {
      var settings = this.getElementSettings();
      var bp = (elementorFrontend &&
        elementorFrontend.config &&
        elementorFrontend.config.breakpoints) || { md: 768, lg: 1025 };

      var desktop = this.getSlidesPerView("desktop");
      var tablet = this.getSlidesPerView("tablet");
      var mobile = this.getSlidesPerView("mobile");

      // loopedSlides: best practice to reduce clone alignment issues when loop true
      var loopedSlides = Math.max(desktop, tablet, mobile);

      var options = {
        slidesPerView: mobile,
        spaceBetween: this.getSpaceBetween("mobile"),
        centeredSlides: false,
        loop: settings.rael_loop === "yes",
        loopedSlides: settings.rael_loop === "yes" ? loopedSlides : 0,
        speed: parseInt(settings.rael_speed || 500, 10),
        cssMode: false,
        resistanceRatio: 0.85,
        grabCursor: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        roundLengths: true, // <- avoid fractional pixel jitter
        useTransform: true, // <- ensure transforms are used
        preventInteractionOnTransition: true,
        autoplay:
          settings.rael_autoplay === "yes"
            ? {
                delay: parseInt(settings.rael_autoplay_speed || 3000, 10),
                disableOnInteraction: false,
              }
            : false,
        navigation:
          settings.rael_show_arrows === "yes"
            ? {
                nextEl:
                  this.$element.find(".elementor-swiper-button-next")[0] ||
                  this.$element.find(".swiper-button-next")[0],
                prevEl:
                  this.$element.find(".elementor-swiper-button-prev")[0] ||
                  this.$element.find(".swiper-button-prev")[0],
              }
            : false,
        pagination:
          settings.rael_pagination === "yes"
            ? {
                el:
                  this.$element.find(".swiper-pagination")[0] ||
                  this.$element.find(".elementor-swiper-pagination")[0],
                clickable: true,
              }
            : false,
        breakpoints: {
          [bp.md]: {
            slidesPerView: tablet,
            spaceBetween: this.getSpaceBetween("tablet"),
          },
          [bp.lg]: {
            slidesPerView: desktop,
            spaceBetween: this.getSpaceBetween("desktop"),
          },
        },
      };

      dlog("Swiper options==", options);
      return options;
    },

    onInit: function () {
      elementorModules.frontend.handlers.Base.prototype.onInit.apply(
        this,
        arguments
      );

      if (typeof Swiper === "undefined") {
        console.error("Swiper is not loaded. Please enqueue Swiper.");
        return;
      }

      var $main = this.elements.$mainSwiper;
      if (!$main.length) {
        dlog("No swiper container found in widget.");
        return;
      }

      // remove only problematic inline width/transform; don't force flex rules
      $main.find(".swiper-slide").each(function () {
        var style = this.getAttribute("style");
        if (style) {
          style = style
            .replace(/\bwidth\s*:\s*[^;]+;?/gi, "")
            .replace(/\btransform\s*:\s*[^;]+;?/gi, "")
            .replace(/^\s*;|;\s*$/g, "")
            .trim();
          if (style) this.setAttribute("style", style);
          else this.removeAttribute("style");
        }
      });
      $main.find(".swiper-wrapper").removeAttr("style");

      // destroy safely
      if (this.swiper && this.swiper.destroy) {
        try {
          this.swiper.destroy(true, true);
        } catch (e) {
          dlog("Error destroying previous swiper:", e);
        }
      }
      this._isTransitioning = false; // guard flag
      this._updateTimer = null;

      var options = this.getSwiperOptions();
      dlog("Initializing Swiper with options:", options);

      try {
        var self = this;
        this.swiper = new Swiper($main[0], options);
        $main.data("swiper", this.swiper);

        // guard: set when transition starts, unset when ends
        this.swiper.on("transitionStart", function () {
          self._isTransitioning = true;
        });

        // delayed update AFTER transition end — avoid mid-animation recalcs
        var postTransitionUpdate = function () {
          clearTimeout(self._updateTimer);
          self._updateTimer = setTimeout(function () {
            // don't update while destroyed
            if (!self.swiper || self.swiper.destroyed) return;
            // only update if not in the middle of another transition
            if (!self._isTransitioning) {
              try {
                self.swiper.update();
                dlog("postTransition update fired");
              } catch (e) {
                dlog("update error:", e);
              }
            }
          }, 160); // slightly longer delay to avoid editor timing issues
        };

        this.swiper.on("transitionEnd", function () {
          self._isTransitioning = false;
          postTransitionUpdate();
        });

        // resize -> delayed update (debounced)
        this._resizeHandler = function () {
          clearTimeout(self._updateTimer);
          self._updateTimer = setTimeout(function () {
            if (!self.swiper || self.swiper.destroyed) return;
            if (!self._isTransitioning) {
              try {
                self.swiper.update();
                dlog("resize-triggered update");
              } catch (e) {
                dlog("update error on resize:", e);
              }
            }
          }, 160);
        };
        window.addEventListener("resize", this._resizeHandler, {
          passive: true,
        });

        // small post-init update
        setTimeout(function () {
          if (self.swiper && !self.swiper.destroyed) {
            try {
              self.swiper.update();
            } catch (e) {
              dlog("initial delayed update error:", e);
            }
          }
        }, 120);
      } catch (err) {
        console.error("Swiper init failed:", err);
      }
    },

    onElementChange: function (propertyName) {
      if (!propertyName) return;
      dlog("onElementChange:", propertyName);

      if (propertyName.indexOf("width") === 0) {
        if (this.swiper && this.swiper.update && !this._isTransitioning) {
          try {
            this.swiper.update();
          } catch (e) {
            dlog("update error on width change:", e);
          }
        }
      }

      if (
        propertyName.indexOf("rael_space_between") === 0 ||
        propertyName.indexOf("rael_slides_per_view") === 0 ||
        propertyName === "rael_loop" ||
        propertyName === "rael_autoplay" ||
        propertyName === "rael_show_arrows" ||
        propertyName === "rael_pagination"
      ) {
        var self = this;
        clearTimeout(this._reinitTimer);
        this._reinitTimer = setTimeout(function () {
          if (self.swiper && self.swiper.destroy) {
            try {
              self.swiper.destroy(true, true);
            } catch (e) {
              dlog("error destroying swiper during reinit:", e);
            }
          }
          self.onInit();
        }, 150); // slightly larger debounce to avoid rapid re-init
        return;
      }

      elementorModules.frontend.handlers.Base.prototype.onElementChange.apply(
        this,
        arguments
      );
    },

    onDestroy: function () {
      if (this._resizeHandler) {
        window.removeEventListener("resize", this._resizeHandler);
        this._resizeHandler = null;
      }
      if (this._updateTimer) {
        clearTimeout(this._updateTimer);
        this._updateTimer = null;
      }
      if (this.swiper && this.swiper.destroy) {
        try {
          this.swiper.destroy(true, true);
        } catch (e) {
          dlog("error destroying swiper onDestroy:", e);
        }
        this.swiper = null;
      }
      elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(
        this,
        arguments
      );
    },
  });

  // Register
  $(window).on("elementor/frontend/init", function () {
    dlog("elementor/frontend/init");
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/rael-media-carousel.default",
      function ($scope) {
        dlog("frontend/element_ready fired for rael-media-carousel", $scope);
        elementorFrontend.elementsHandler.addHandler(MediaCarouselHandler, {
          $element: $scope,
        });
      }
    );
  });
})(jQuery);
