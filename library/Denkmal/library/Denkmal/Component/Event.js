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

    this.$('.event').toggleClass('event-details-open', state);

    var self = this;
    this._getDetails().then(function(details) {
      self.trigger('toggleDetails', state);
      if (state) {
        details.$el.slideDown('fast', function() {
          self.trigger('toggleDetails-open');
        });
      } else {
        details.$el.slideUp('fast');
      }
    });

    this._detailsVisible = state;
  },

  /**
   * @returns Promise
   */
  _getDetails: function() {
    var details = this.findChild('Denkmal_Component_EventDetails');
    if (details) {
      return Promise.resolve(details);
    }
    var $container = this.$('.event').parent();
    return this.prepareComponent('Denkmal_Component_EventDetails', {venue: this.venue, event: this.event})
      .then(function(component) {
        component.$el.hide().appendTo($container);
        return component;
      });
  }
});
