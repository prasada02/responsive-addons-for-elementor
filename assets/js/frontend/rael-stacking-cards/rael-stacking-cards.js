function initStackingCards($scope) {
  const cards = gsap.utils.toArray($scope.find(".rael-stacking-card"));

  cards.forEach((card, index) => {
    const baseX = parseFloat(card.dataset.translateX) || 0;
    const baseY = parseFloat(card.dataset.translateY) || 0;

    const baseRotate = parseFloat(card.dataset.rotate) || 0;
    const scrollRotate = parseFloat(card.dataset.scrollrotate) || 0;

    const baseScale = parseFloat(card.dataset.scale) || 1;
    const baseBlur = parseFloat(card.dataset.blur) || 0;

    const baseGreyscale = parseFloat(card.dataset.greyscale) || 0;
    const scrollGreyscale = parseFloat(card.dataset.scrollgreyscale) || 0;


    // Exclude last card
    if (index === cards.length - 1) return;

    ScrollTrigger.create({
      trigger: card,
      start: "bottom top",
      onEnter: () => {
        gsap.to(card, {
          x: baseX + index * 5,
          y: baseY + index * 10,
          rotate: scrollRotate,
          scale: baseScale,
          filter: `blur(${baseBlur}px) grayscale(${scrollGreyscale}%)`,
          opacity: 1,
          overwrite: "auto",
          duration: 0.4,
          ease: "power2.out",
        });
      },
      onLeaveBack: () => {
        gsap.to(card, {
          x: baseX,
          y: baseY,
          rotate: baseRotate,
          scale: baseScale,
          filter: `blur(0px) grayscale(${baseGreyscale}%)`,
          opacity: 1,
          overwrite: "auto",
          duration: 0.4,
          ease: "power2.out",
        });
      },
    });
  });
}

// Elementor frontend + editor support
jQuery(window).on("elementor/frontend/init", function () {
  // Frontend and editor hook
  if (
    typeof elementorFrontend !== "undefined" &&
    typeof elementorFrontend.hooks !== "undefined"
  ) {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/rael-stacking-cards.default",
      function ($scope) {
        initStackingCards($scope); // your GSAP stacking init
      }
    );
  }

  // Editor live preview: recalc after load
  if (elementorFrontend.isEditMode()) {
    jQuery(window).on("load", function () {
      jQuery(".rael-stacking-cards").each(function () {
        initStackingCards(jQuery(this));
      });
    });
  }
});
