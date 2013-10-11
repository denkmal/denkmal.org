/**
 * @class Denkmal_Layout_Default
 * @extends CM_Layout_Abstract
 */
var Denkmal_Layout_Default = CM_Layout_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Layout_Default',

	childrenEvents: {
		'Denkmal_Page_Events ready': function(view) {

			var $layout = this.$el;
			var $pageScrollables = view.$('.scrollable');

			var onScroll = function() {
				var scrolledNotTop = view.$('.active .scrollable').scrollTop() > 20;
				$layout.toggleClass('scrolledNotTop', scrolledNotTop);
			};

			$pageScrollables.bind('scroll', onScroll);
			view.on('destruct', function() {
				$pageScrollables.unbind('scroll', onScroll);
			});
			view.on('swipe', function($element) {
				onScroll();
			});
			onScroll();
		}
	}
});
