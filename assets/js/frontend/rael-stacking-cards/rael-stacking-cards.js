class RaelStackingCardsHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        wrapper: ".rae-stacking-cards-wrapper",
        card: ".rae-stacking-card",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      $wrapper: this.$element.find(selectors.wrapper),
      $cards: this.$element.find(selectors.card),
    };
  }

  initStackingCards() {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
      return;
    }

    gsap.registerPlugin(ScrollTrigger);

    const cards = this.elements.$cards.toArray();

    cards.forEach((card, i) => {
      gsap.to(card, {
        scale: 0.9,
        opacity: 0.7,
        zIndex: cards.length - i,
        scrollTrigger: {
          trigger: card,
          start: "top center+=100",
          scrub: true,
          onEnter: () => gsap.to(card, { scale: 1, opacity: 1, duration: 0.3 }),
          onLeaveBack: () =>
            gsap.to(card, { scale: 0.9, opacity: 0.7, duration: 0.3 }),
        },
      });
    });
  }

  onInit(...args) {
    super.onInit(...args);
    this.initStackingCards();
  }

  onElementChange(propertyName) {
    // If user updates repeater or settings in editor, re-init
    if (propertyName.startsWith("items_list")) {
      this.initStackingCards();
    }
  }
}

jQuery(window).on("elementor/frontend/init", () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(RaelStackingCardsHandler, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rael-stacking-cards.default",
    addHandler
  );
});
