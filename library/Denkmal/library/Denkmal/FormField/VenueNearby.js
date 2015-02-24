/**
 * @class Denkmal_FormField_VenueNearby
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_VenueNearby = CM_FormField_Abstract.extend({
  _class: 'Denkmal_FormField_VenueNearby',

  ready: function() {
    this.detectLocation();
  },

  /**
   * @return Promise
   */
  detectLocation: function() {
    if (!'geolocation' in navigator) {
      this._setStateFailure();
      return;
    }

    this._setStateWaiting();

    var self = this;
    var deferred = $.Deferred();
    navigator.geolocation.getCurrentPosition(deferred.resolve, deferred.reject);

    deferred.then(function(position) {
      return self._lookupCoordinates(position.coords.latitude, position.coords.longitude)
    });
    deferred.fail(function() {
      self._setStateFailure();
    });

    return deferred;
  },

  /**
   * @param {Number} lat
   * @param {Number} lon
   * @return jqXHR
   */
  _lookupCoordinates: function(lat, lon) {
    var self = this;
    return this.ajax('getVenuesByCoordinates', {lat: lat, lon: lon}, {
      success: function(venueList) {
        if (venueList.length == 0) {
          self._setStateFailure();
        } else {
          self._setStateSuccess(venueList);
        }
      }, error: function() {
        self._setStateFailure();
      }
    });
  },

  _setStateWaiting: function() {
    this.trigger('waiting');
  },

  _setStateFailure: function() {
    this.trigger('failure');
  },

  /**
   * @param {Array} venueList
   */
  _setStateSuccess: function(venueList) {
    var $select = this.getInput();
    $select.empty();
    _.each(venueList, function(venue) {
      $select.append($('<option></option>').attr('value', venue.id).text(venue.name));
    });
    $select.trigger('change');

    this.trigger('success');
  }
});
