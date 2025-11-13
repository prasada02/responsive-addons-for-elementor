function initStackingCards($scope) {
  console.log("Initializing Stacking Cards");
  const cards = gsap.utils.toArray($scope.find(".rael-stacking-card"));
  const total = cards.length;

  cards.forEach((card, index) => {
    const gapValue = card.dataset.gap || "50px";
    const gapMatch = gapValue.match(/^([0-9.]+)([a-z%]*)$/);
    const gapNum = gapMatch ? parseFloat(gapMatch[1]) : 0;

    const baseX = parseFloat(card.dataset.translateX) || 0;
    const baseY = parseFloat(card.dataset.translateY) || 0;
    const baseRotate = parseFloat(card.dataset.rotate) || 0;
    const scrollRotate = parseFloat(card.dataset.scrollrotate) || baseRotate;
    const baseScale = parseFloat(card.dataset.scale) || 1;
    const baseBlur = parseFloat(card.dataset.blur) || 0;
    const baseGreyscale = parseFloat(card.dataset.greyscale) || 0;
    const scrollGreyscale = parseFloat(card.dataset.scrollgreyscale) || 0;

    const rawScrollScale = parseFloat(card.dataset.scale) || 0;
    console.log('rawScrollScale='+rawScrollScale);
    const direction = rawScrollScale < 0 ? -1 : 1;
    const absScrollScale = Math.abs(rawScrollScale);

    // ---- NEW LOGIC ----
    const distanceFromFront = total - 1 - index;
    const scaleStep = absScrollScale * 0.1;
    const baseCardScale = 1 - distanceFromFront * scaleStep;
    console.log("baseCardScale=" + baseCardScale);
    const scrollCardScale = 1 - distanceFromFront * (scaleStep + 0.015);
    console.log("scrollCardScale=" + scrollCardScale);
    const depthOffset = distanceFromFront * 10 * direction;
    // --------------------

    // ✅ Explicitly use transform string for correct scale(x, y) output
    const setTransform = `translate3d(0px, 0px, 0px) rotate(${baseRotate}deg) scale(${baseCardScale}, ${baseCardScale})`;

    gsap.set(card, {
      //transform: setTransform,
      // transformOrigin: "center center",
      // transformStyle: "preserve-3d",
      x: baseX,
      rotate: baseRotate,
      scaleX: baseCardScale,
      scaleY: baseCardScale,
      filter: `blur(0px) grayscale(${baseGreyscale}%)`,
      opacity: 1,
    });

    ScrollTrigger.create({
      trigger: card,
      start: "bottom top",
      onEnter: () => {
        gsap.to(card, {
          x: baseX,
          rotate: scrollRotate,
          scaleX: scrollCardScale,
          scaleY: scrollCardScale,
          duration: 0.4,
          ease: "power2.out",
          overwrite: "auto",
        });
      },
      onLeaveBack: () => {
        gsap.to(card, {
          x: baseX,
          rotate: baseRotate,
          scaleX: baseCardScale,
          scaleY: baseCardScale,
          duration: 0.4,
          ease: "power2.out",
          overwrite: "auto",
        });
      },
    });
  });
}

// Elementor frontend + editor support
jQuery(window).on("elementor/frontend/init", function () {
  if (
    typeof elementorFrontend !== "undefined" &&
    typeof elementorFrontend.hooks !== "undefined"
  ) {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/rael-stacking-cards.default",
      function ($scope) {
        const wrapper = $scope.find(".rael-stacking-cards-wrapper");
        const parent = wrapper.closest(".elementor-widget-rael-stacking-cards");

        if (parent.length) {
          const cardHeight = wrapper.data("card-height");
          const cardOffset = wrapper.data("card-offset");
          parent[0].style.setProperty("--card-height", cardHeight);
          parent[0].style.setProperty("--card-top-offset", cardOffset);
        }

        initStackingCards($scope);
      }
    );
  }

  if (elementorFrontend.isEditMode()) {
    jQuery(window).on("load", function () {
      jQuery(".rael-stacking-cards").each(function () {
        const $scope = jQuery(this);
        const wrapper = $scope.find(".rael-stacking-cards-wrapper");
        const parent = wrapper.closest(".elementor-widget-rael-stacking-cards");

        if (parent.length) {
          const cardHeight = wrapper.data("card-height");
          const cardOffset = wrapper.data("card-offset");
          parent[0].style.setProperty("--card-height", cardHeight);
          parent[0].style.setProperty("--card-top-offset", cardOffset);
        }

        initStackingCards(jQuery(this));
      });
    });
  }
});
