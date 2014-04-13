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
    'Denkmal_Component_SongPlayerButton play': function(view, song) {
      this.showSongDetails(song.label);
    },
    'Denkmal_Component_SongPlayerButton pause': function() {
      this.hideSongDetails(false);
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

  hideSongDetails: function() {
    this.$('.event').removeClass('song-details-open');
    this.$('.songDetails').slideUp('fast');
  },

  /**
   * @param {String} label
   */
  showSongDetails: function(label) {
    this.$('.event').addClass('song-details-open');
    this.$('.songDetails').slideDown('fast').find('.label').text(label);
  }
});
