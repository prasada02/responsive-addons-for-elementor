function initStackingCards($scope) {
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
    console.log("baseScale=" + baseScale);
    const baseBlur = parseFloat(card.dataset.blur) || 0;
    const baseGreyscale = parseFloat(card.dataset.greyscale) || 0;
    const scrollGreyscale = parseFloat(card.dataset.scrollgreyscale) || 0;

    // ✅ FIXED: use dataset.scrollscale and handle conditional scaling
    const rawScrollScale = parseFloat(card.dataset.scale) || 0;
    console.log("rawScrollScale=" + rawScrollScale);
    const direction = rawScrollScale < 0 ? -1 : 1;
    const absScrollScale = Math.abs(rawScrollScale);

    // ---- NEW LOGIC ----
    const distanceFromFront = total - 1 - index;

    // Each card slightly smaller than the one in front
    const scaleStep = absScrollScale * 0.1;
    const baseCardScale = 1 - distanceFromFront * scaleStep;
    console.log("baseCardScale=" + baseCardScale);
    const scrollCardScale = 1 - distanceFromFront * (scaleStep + 0.015);
    console.log("scrollCardScale=" + scrollCardScale);

    // Slight depth offset for side visibility
    const depthOffset = distanceFromFront * 10 * direction;

    // ✅ Build transform config conditionally
    const setConfig = {
      x: baseX,
      // y: baseY,
      // z: depthOffset,
      rotate: baseRotate,
      filter: `blur(0px) grayscale(${baseGreyscale}%)`,
      opacity: 1,
    };

    if (rawScrollScale !== 0) {
      setConfig.scaleX = baseCardScale;
      setConfig.scaleY = baseCardScale;
    }

    gsap.set(card, setConfig);

    ScrollTrigger.create({
      trigger: card,
      start: "bottom top",
      onEnter: () => {
        const enterConfig = {
          x: baseX,
          // y: baseY,
          // z: depthOffset,
          rotate: scrollRotate,
          filter: `blur(${baseBlur}px) grayscale(${scrollGreyscale}%)`,
          opacity: 1,
          overwrite: "auto",
          duration: 0.4,
          ease: "power2.out",
        };

        if (rawScrollScale !== 0) {
          enterConfig.scaleX = scrollCardScale;
          enterConfig.scaleY = scrollCardScale;
        }

        gsap.to(card, enterConfig);
      },
      onLeaveBack: () => {
        const leaveConfig = {
          x: baseX,
          // y: baseY,
          // z: depthOffset,
          rotate: baseRotate,
          filter: `blur(0px) grayscale(${baseGreyscale}%)`,
          opacity: 1,
          overwrite: "auto",
          duration: 0.4,
          ease: "power2.out",
        };

        if (rawScrollScale !== 0) {
          leaveConfig.scaleX = baseCardScale;
          leaveConfig.scaleY = baseCardScale;
        }

        gsap.to(card, leaveConfig);
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
