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

  /**
   * @param {Boolean} [state]
   */
  toggleDetails: function(state) {
    if ('undefined' === typeof state) {
      state = !this._detailsVisible;
    }
    if (this._detailsVisible === state) {
      return;
    }

    var $event = this.$('.event');
    var details = this.findChild('Denkmal_Component_EventDetails');

    $event.toggleClass('event-details-open', state);

    var done = new $.Deferred();
    done.resolve();

    if (details) {
      if (state) {
        details.$el.slideDown('fast');
      } else {
        details.$el.slideUp('fast');
      }
    } else if (state) {
      done = this.loadComponent('Denkmal_Component_EventDetails', {venue: this.venue, event: this.event}, {
        'success': function() {
          this.$el.hide().appendTo($event.parent()).slideDown('fast');
        }
      });
    }

    var self = this;
    done.done(function() {
      self.trigger('toggleDetails', state)
    });

    this._detailsVisible = state;
  }
});
