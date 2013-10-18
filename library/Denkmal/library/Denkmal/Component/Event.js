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
		'click .showDetails': 'showDetails'
	},

	childrenEvents: {
		'Denkmal_Component_SongPlayerButton play': function(e, song) {
			this.showSongDetails(song);
		},
		'Denkmal_Component_SongPlayerButton pause': function() {
			this.showSongDetails();
		}
	},

	showDetails: function() {
		var $event = this.$('.event');
		var details = this.findChild('Denkmal_Component_EventDetails');

		$event.toggleClass('event-details-open');

		if (details) {
			details.$el.slideToggle('fast');
		} else {
			this.loadComponent('Denkmal_Component_EventDetails', {venue: this.venue, event: this.event}, {
				'success': function() {
					this.$el.hide().appendTo($event.parent()).slideDown('fast');
				}
			});
		}
	},

	showSongDetails: function(song) {
		var $event = this.$('.event');
		var songDetails = this.findChild('Denkmal_Component_SongDetails');

		$event.toggleClass('song-details-open');

		if (songDetails) {
			songDetails.$el.slideToggle('fast');
		} else {
			this.loadComponent('Denkmal_Component_SongDetails', {song: song}, {
				'success': function() {
					this.$el.hide().prependTo($event.parent()).slideDown('fast');
				}
			});
		}
	}
});
