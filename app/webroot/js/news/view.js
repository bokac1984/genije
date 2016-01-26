var ViewDefaults = function () {
	// function to initiate FlexSlider
	var runFlexSlider = function(options) {
		$(".flexslider").each(function() {
			var slider = $(this);
			var defaults = {
				animation: "slide",
				animationLoop: false,
				controlNav: true,
				directionNav: false,
				slideshow: false,
				prevText: "",
				nextText: ""
			};
			var config = $.extend({}, defaults, options, slider.data("plugin-options"));
			if( typeof config.sync !== 'undefined') {
				var carousel = {
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					prevText: "",
					nextText: "",
					asNavFor: slider
				};
				var configCarousel = $.extend({}, carousel, $(config.sync).data("plugin-options"));
				$(config.sync).flexslider(configCarousel);
			}
			// Initialize Slider
			slider.flexslider(config);
		});
	};
    return {
        //main function to initiate template pages
        init: function () {
            runFlexSlider();
        }
    };
}();