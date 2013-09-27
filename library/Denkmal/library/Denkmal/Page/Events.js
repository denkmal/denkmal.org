/**
 * @class Denkmal_Page_Events
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Events = Denkmal_Page_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Page_Events',

	ready: function() {
		var carousel = new Carousel(".swipeCarousel");
		carousel.init();
	}
});
