/**
 * @class Denkmal_FormField_VenueNearby
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_VenueNearby = CM_FormField_Abstract.extend({
  _class: 'Denkmal_FormField_VenueNearby',

  /** @type {Number} */
  _watchId: null,

  /** @type {Number} */
  _timeoutId: null,

  ready: function() {
    this.detectLocation();
  },

  detectLocation: function() {
    if (!'geolocation' in navigator) {
      this._setStateFailure();
      return;
    }

    var self = this;

    this._setStateWaiting();
    window.clearTimeout(this._timeoutId);
    this._timeoutId = this.setTimeout(function() {
      self._setStateFailure();
    }, 1000 * 10);

    if (!this._watchId) {
      this._watchId = navigator.geolocation.watchPosition(_.throttle(function(position) {
        window.clearTimeout(self._timeoutId);
        self._lookupCoordinates(position.coords.latitude, position.coords.longitude, position.coords.accuracy);
      }, 1000), function() {
        window.clearTimeout(self._timeoutId);
        self._setStateFailure();
      }, {
        enableHighAccuracy: true
      });
      this.on('destruct', function() {
        navigator.geolocation.clearWatch(self._watchId);
      });
    }
  },

  /**
   * @param {Number} lat
   * @param {Number} lon
   * @param {Number} radius
   * @return jqXHR
   */
  _lookupCoordinates: function(lat, lon, radius) {
    var self = this;
    return this.ajax('getVenuesByCoordinates', {lat: lat, lon: lon, radius: radius}, {
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
    var valueBackup = $select.val();
    $select.empty();
    _.each(venueList, function(venue) {
      $select.append($('<option></option>').attr('value', venue.id).text(venue.name));
    });
    if (null !== valueBackup) {
      $select.val(valueBackup);
    }
    $select.trigger('change');

    this.trigger('success');
  }
});
