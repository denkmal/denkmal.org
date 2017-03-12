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
      var state = ('' === $element.attr('data-bookmarked'));
      this.setVenueBookmark(!state);
      event.stopPropagation();
    },
    'mousedown .toggleVenueBookmark': function(event) {
      //prevent click feedback
      event.stopPropagation();
    }
  },

  appEvents: {
    'venue-bookmarks:changed': function(data) {
      if (this._venue && ('' + this._venue.id) == data['venueId']) {
        this._updateVenueBookmark(data['state']);
      }
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
  },

  /**
   * @returns {Object}
   */
  getEvent: function() {
    return this.getParams()['event'];
  },

  /**
   * @param {Boolean} state
   * @private
   */
  _updateVenueBookmark: function(state) {
    var $el = this.$('.venue-bookmark');
    state ? $el.attr('data-bookmarked', '') : $el.removeAttr('data-bookmarked');
    $el.toggleClass('bookmark-animation', state);
  }

});
