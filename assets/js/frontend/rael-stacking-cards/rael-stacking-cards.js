jQuery(window).on("elementor/frontend/init", function () {
  // Initialize stacking cards using GSAP + ScrollTrigger
  function initStackingCards($container, options) {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined")
      return;

    const cards = $container.find(".rael-stacking-card").toArray();

    const stickyTop = parseInt(options.sticky_position_top_space?.size) || 150;
    const cardGap = parseInt(options.card_gap?.size) || 100;
    const cardOffset = parseInt(options.card_top_offset?.size) || 20;


    // Initial state
    gsap.set(cards, { scale: 0.9, opacity: 1, zIndex: 0 });
console.log("stickyTop=" + stickyTop);
    // Assign ScrollTrigger to each card
    cards.forEach((card, i) => {
      ScrollTrigger.create({
        trigger: card,
        start: "top+=" + (stickyTop + i * cardGap) + " center",
        end: "+=" + cardOffset,
        onToggle: ({ isActive }) => {
          if (isActive) {
            gsap.to(card, {
              scale: isActive ? 1 : 0.9,
              zIndex: isActive ? 10 + i : i,
              duration: 0.4,
              ease: "power2.out",
            });
          } else {
            gsap.to(card, {
              scale: 0.9,
              zIndex: i,
              duration: 0.4,
              ease: "power2.inOut",
            });
          }
        },
      });
    });
  }

  // Elementor hook to render stacking cards
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rael-stacking-cards.default",
    function ($scope, $) {
      const settings = $scope.data("settings");

      if (!settings || !settings.items_list) return;

      const $cardsContainer = $scope.find(".rae-stacking-cards-wrapper");

       if ($cardsContainer.length) {
         initStackingCards($cardsContainer, settings);
       }
     
    }
  );
});
