/**
 * @class Denkmal_Component_HeaderBar
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_HeaderBar = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_HeaderBar',

	/** @type Boolean */
	narrow: null,

	events: {
		'clickNoMeta .menu.dates a': function(event) {
			var url = $(event.currentTarget).attr('href');
			return this.activateMenu(url);
		},

		'click .showWeek': function() {
			this.toggleMenu(true);
		},

		'click .menu.dates .active .navButton': function() {
			if (!this.narrow) {
				return;
			}
			this.toggleMenu(true);
		},

		'click .menu-expand .menu.dates .navButton': function() {
			if (!this.narrow) {
				return;
			}
			this.toggleMenu(false);
		}
	},

	ready: function() {
		var self = this;
		var handlers = {
			match: function() {
				self.narrow = true;
			},
			unmatch: function() {
				self.narrow = false;
				self.toggleMenu(false);
			}

		};

		enquire.register('(max-width: 580px)', handlers);

		this.on('destruct', function() {
			enquire.unregister('(max-width: 580px)', handlers);
		});
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
