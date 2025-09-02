(function ($) {
  $(window).on("elementor/frontend/init", function () {
    // Initialize stacking cards using GSAP + ScrollTrigger
    function initStackingCards($container, options) {
      if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined")
        return;

      const cards = $container.find(".rael-stacking-card").toArray();

      const stickyTop =
        parseInt(options.sticky_position_top_space?.size) || 150;
      const cardGap = parseInt(options.card_gap?.size) || 100;
      const cardOffset = parseInt(options.card_top_offset?.size) || 20;

      // Loop through cards
      cards.forEach((card, i) => {
        //  Dynamic scale per card 
        const baseScale = 1;
        const scaleStep = 0.025; // how much smaller each card gets
        const cardScale = baseScale - i * scaleStep;
       const offsetStepX = 20; // how much each card shifts horizontally
        const offsetStepY = 15; 
        const cardX = i * offsetStepX;
        const cardY = i * offsetStepY;

        // Set initial state
        gsap.set(card, {
          x: cardX,
          y: cardY,
          scale: cardScale,
          opacity: 1,
          zIndex: cards.length - i,
          transformOrigin: `${options.transform_origin_x || 0}% ${
            options.transform_origin_y || 0
          }%`,
        });

        // Add ScrollTrigger
        ScrollTrigger.create({
          trigger: card,
          start: "top+=" + (stickyTop + i * cardGap) + " center",
          end: "+=" + cardOffset,
          onToggle: ({ isActive }) => {
            gsap.to(card, {
              x: isActive ? 0 : cardX,
              y: isActive ? 0 : cardY,
              scale: isActive ? 1 : cardScale,
              opacity: isActive ? 1 : cardOpacity,
              zIndex: isActive ? cards.length + i : i,
              duration: 0.6,
              ease: "power3.inOut",
            });
          },
        });
      });
    }


    // Elementor hook to render stacking cards
    // elementorFrontend.hooks.addAction(
    //   "frontend/element_ready/rael-stacking-cards.default",
    //   function ($scope, $) {
    //     console.log("Stacking cards widget initialized");
    //     const settings = $scope.data("settings");

    //     if (!settings || !settings.items_list) return;

    //     const $cardsContainer = $scope.find(".rael-stacking-cards-wrapper");

    //     if ($cardsContainer.length) {
    //       initStackingCards($cardsContainer, settings);
    //     }
    //   }
    // );
     elementorFrontend.hooks.addAction(
       "frontend/element_ready/rael-stacking-cards.default",
       function ($scope, $) {
         const settings = $scope.data("settings");
         const $container = $scope.find(".rael-stacking-cards-wrapper");
         if (settings?.items_list && $container.length) {
           initStackingCards($container, settings);
         }
       }
     );
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/global",
      function ($scope) {
        console.log("Global ready", $scope);
      }
    );
  });
})(jQuery);