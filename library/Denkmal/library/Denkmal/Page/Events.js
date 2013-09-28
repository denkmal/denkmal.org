/**
 * @class Denkmal_Page_Events
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Events = Denkmal_Page_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Page_Events',

	/** @type Carousel */
	_carousel: null,

	events: {
		'swipeCarousel-change .swipeCarousel': function(event, data) {
			this._onShowPane($(data.element));
		}
	},

	ready: function() {
		var $carousel = this.$('.swipeCarousel');
		$carousel.removeClass('beforeload');
		this._carousel = new Carousel(".swipeCarousel");
		this._carousel.init();
	},

	/**
	 * @param {String} url
	 * @returns Boolean
	 */
	showPane: function(url) {
		var $element = this.$('.dateList > .date[data-url="' + url + '"]');
		if ($element.length) {
			this._carousel.showPane($element.index());
			return true;
		} else {
			return false;
		}
	},

	/**
	 * @param {jQuery} $element
	 */
	_onShowPane: function($element) {
		var title = $element.data('title');
		var url = $element.data('url');
		var menuEntryHash = $element.data('menu-entry-hash');
		var page = cm.findView('CM_Page_Abstract');

		cm.router.pushState(url);
		cm.findView()._onPageSetup(this, title, url, [menuEntryHash]);
	}
});
