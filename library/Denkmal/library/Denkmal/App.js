/**
 * @class Denkmal_App
 * @extends CM_App
 */
var Denkmal_App = CM_App.extend({

  registerServiceWorker: function() {
    if ('serviceWorker' in navigator) {
      var url = cm.getUrlServiceWorker();

      navigator.serviceWorker.register(url, {scope: cm.getUrl() + '/'}).then(function(registration) {
        cm.debug.log('ServiceWorker registration succeeded.');
      }).catch(function(error) {
        cm.debug.log('ServiceWorker registration failed.', error);
      });
    } else {
      cm.debug.log('ServiceWorker not supported.');
    }
  },

  venueBookmarks: {
    /**
     * @param {String} venueId
     */
    addVenue: function(venueId) {
      venueId = '' + venueId;
      var venueList = this.getVenues();
      venueList.push(venueId);
      venueList = _.uniq(venueList);
      this._setVenues(venueList);
      cm.event.trigger('venue-bookmarks:changed', {venueId: venueId, state: true});
    },

    /**
     * @param {String} venueId
     */
    removeVenue: function(venueId) {
      venueId = '' + venueId;
      var venueList = this.getVenues();
      venueList = _.reject(venueList, function(venue) {
        return venue === venueId;
      });
      this._setVenues(venueList);
      cm.event.trigger('venue-bookmarks:changed', {venueId: venueId, state: false});
    },

    /**
     * @param {String} venueId
     * @param {Boolean} state
     */
    setVenue: function(venueId, state) {
      state ? this.addVenue(venueId) : this.removeVenue(venueId);
    },

    /**
     * @returns {Array<String>}
     */
    getVenues: function() {
      var cookie = $.cookie('venue-bookmarks');
      var venueList = [];
      if (cookie) {
        try {
          venueList = JSON.parse(cookie);
          venueList.forEach(function(venueId) {
            return '' + venueId;
          });
        } catch (error) {
          console.log('Error reading venue-bookmarks', error);
          venueList = [];
        }
      }
      return venueList;
    },

    /**
     * @param {Array<String>} venueIdList
     * @private
     */
    _setVenues: function(venueIdList) {
      $.cookie('venue-bookmarks', JSON.stringify(venueIdList));
    }
  }

});
