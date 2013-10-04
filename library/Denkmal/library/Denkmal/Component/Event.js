/**
 * @class Denkmal_Component_Event
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_Event = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_Event',

	/** @type {Object} */
	venue: null,

	/** @type {Object} */
	event: null,

	events: {
		'click .showDetails': 'loadDetails'
	},

	loadDetails: function() {
		var handler = this;
		var details = this.findChild('Denkmal_Component_EventDetails');
		if (details) {
			details.$el.slideToggle('fast');
		} else {
			this.loadComponent('Denkmal_Component_EventDetails', {venue: this.venue, event: this.event}, {
				'success': function() {
					this.$el.hide().appendTo(handler.$('.event-content')).slideDown('fast');
				}
			});
		}
	}
});
