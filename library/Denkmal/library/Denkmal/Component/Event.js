/**
 * @class Denkmal_Component_Event
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_Event = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_Event',

  /** @type Object|Null */
  _venue: null,

  events: {
    'click .toggleVenueBookmark': function(event) {
      var $element = $(event.currentTarget);
      var state = ('' === $element.data('bookmarked'));
      this.setVenueBookmark(!state);
    }
  },

  /**
   * @param {Boolean} state
   */
  setVenueBookmark: function(state) {
    if (!this._venue) {
      return;
    }
    cm.venueBookmarks.setVenue(this._venue.id, state);
  }

});
