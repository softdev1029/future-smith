(function ($) {
	var fn = {
		init: function() {
			this.bindEvents();
			this.render();
		},

		bindEvents: function() {

		},

		render: function() {
			$('.projects-slide').owlCarousel({
                center: true,
                items: 2,
                loop: true,
                margin: 10,
                responsive: {
                  600: {
                    items: 4
                  }
                }
            });
			$('.tribes').owlCarousel({
                center: true,
                items: 2,
                loop: true,
                margin: 10,
                responsive: {
									600: {
                    items: 3
                  },
                  1000: {
                    items: 4
                  }
                }
            });
		}
	};

	fn.init();
})(jQuery);
