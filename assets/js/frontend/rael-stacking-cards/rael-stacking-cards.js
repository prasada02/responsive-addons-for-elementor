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

    // set initial states
    gsap.set(cards, { scale: 0.9, opacity: 1, zIndex: 0 });

    // Give each card a descending z-index initially

    cards.forEach((card, i) => {
      ScrollTrigger.create({
        trigger: card,
        start: "top center+=100",
        end: "bottom center",
        onToggle: ({ isActive }) => {
          if (isActive) {
            // only animate the active card
            gsap.to(card, {
              scale: 1,
              zIndex: 10 + i,
              duration: 0.4,
              ease: "power2.out",
            });
          } else {
            // smoothly reset card when leaving
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

  onInit(...args) {
    super.onInit(...args);
    this.initStackingCards();
  }

  onElementChange() {
    this.initStacking(); // Re-run when settings change
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
