/**
 * @class Denkmal_Component_EventList
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventList = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_EventList',

  childrenEvents: {
    'Denkmal_Component_Event toggleDetails': function(eventView, state) {
      if (state) {
        this.closeAllEvents(eventView);
      }
    }
  },

  /**
   * @param {Denkmal_Component_Event} excludeEventView
   */
  closeAllEvents: function(excludeEventView) {
    _.each(this.getChildren('Denkmal_Component_Event'), function(eventView) {
      if (eventView !== excludeEventView) {
        eventView.toggleDetails(false);
      }
    }, this);
  }
});
