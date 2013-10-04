/**
 * @class Denkmal_Component_HeaderBar
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_HeaderBar = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_HeaderBar',

	events: {
		'clickNoMeta .menu.dates a': function(event) {
			var url = $(event.currentTarget).attr('href');
			return this.activateMenu(url);
		},

		'click .showWeek': function() {
			this.toggleMenu(true);
		},

		'click .menu.dates .navButton': function() {
			this.toggleMenu(false);
		}
	},

	/**
	 * @param {String} url
	 */
	activateMenu: function(url) {
		var pageEvents = cm.findView('Denkmal_Page_Events');
		if (!pageEvents) {
			return true;
		}
		return !pageEvents.showPane(url);
	},

	/**
	 *
	 * @param {Boolean} state
	 */
	toggleMenu: function(state) {
		this.$('.bar').toggleClass('menu-expand', state);
	}

});
