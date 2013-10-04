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

	ready: function() {
		var self = this;
		var mediaQueryNavigationFull = enquire.register('(min-width: 580px)', {
			match: function() {
				self.$('.showWeek').hide();
			},
			unmatch: function() {
				self.$('.showWeek').show();
			}
		});

		this.on('destruct', function() {
			mediaQueryNavigationFull.unregister();
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
		var $menu = this.$('.menu.dates');
		var $hideElements = this.$('.logoWrapper, .addButton, .showWeek');
		$menu.toggleClass('full', state);
		$hideElements.toggle(!state);
	}

});
