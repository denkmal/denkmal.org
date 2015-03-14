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

    var deferredLoaded = new $.Deferred();
    var deferredOpened = new $.Deferred();

    if (details) {
      deferredLoaded.resolve();
      if (state) {
        details.$el.slideDown('fast', deferredOpened.resolve);
      } else {
        details.$el.slideUp('fast');
      }
    } else if (state) {
      deferredLoaded = this.loadComponent('Denkmal_Component_EventDetails', {venue: this.venue, event: this.event}, {
        'success': function() {
          this.$el.hide().appendTo($event.parent()).slideDown('fast', deferredOpened.resolve);
        }
      });
    }

    var self = this;
    deferredLoaded.done(function() {
      self.trigger('toggleDetails', state)
    });
    deferredOpened.done(function() {
      self.trigger('toggleDetails-open');
    });

    this._detailsVisible = state;
  }
});
