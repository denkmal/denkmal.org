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
    'Denkmal_Component_SongPlayerButton play': function() {
      this.showSongDetails();
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

  showSongDetails: function() {
    this.$('.event').toggleClass('song-details-open');
    this.$('.songDetails').slideToggle('fast');
  }
});
