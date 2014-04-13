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

  /** @type {Boolean} */
  _detailsVisible: false,

  events: {
    'click .showDetails': function() {
      this.toggleDetails();
    }
  },

  childrenEvents: {
    'Denkmal_Component_SongPlayerButton play': function() {
      this.showSongDetails();
    },
    'Denkmal_Component_SongPlayerButton pause': function() {
      this.showSongDetails();
    }
  },

  /**
   * @param {Boolean} [state]
   */
  toggleDetails: function(state) {
    if ('undefined' === typeof state) {
      state = !this._detailsVisible;
    }
    var $event = this.$('.event');
    var details = this.findChild('Denkmal_Component_EventDetails');

    $event.toggleClass('event-details-open', state);

    if (details) {
      if (state) {
        details.$el.slideDown('fast');
      } else {
        details.$el.slideUp('fast');
      }
    } else if (state) {
      this.loadComponent('Denkmal_Component_EventDetails', {venue: this.venue, event: this.event}, {
        'success': function() {
          this.$el.hide().appendTo($event.parent()).slideDown('fast');
        }
      });
    }

    this._detailsVisible = state;
  },

  showSongDetails: function() {
    this.$('.event').toggleClass('song-details-open');
    this.$('.songDetails').slideToggle('fast');
  }
});
