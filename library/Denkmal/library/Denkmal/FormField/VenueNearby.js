/**
 * @class Denkmal_FormField_VenueNearby
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_VenueNearby = CM_FormField_Abstract.extend({
  _class: 'Denkmal_FormField_VenueNearby',

  /** @type {Number} */
  _watchId: null,

  /** @type {Number} */
  _waitingTimeoutId: null,

  /** @type {Boolean} */
  _keepSelection: null,

  /** @type {String} */
  _stateGeo: null,

  /** @type {Deferred} */
  _lookupCoordinatesDeferred: null,

  ready: function() {
    this._watchId = null;
    this._waitingTimeoutId = null;
    this._keepSelection = false;
    this._stateGeo = null;

    this.detectLocation();

    var self = this;
    this.getForm().$el.on('reset', function() {
      self.setKeepSelection(false);
    });
  },

  detectLocation: function() {
    if (!'geolocation' in navigator) {
      this._setStateFailure();
      return;
    }

    var self = this;
    this._setStateWaiting();

    if (this._watchId) {
      navigator.geolocation.clearWatch(this._watchId);
    }
    this._watchId = navigator.geolocation.watchPosition(_.throttle(function(position) {
      self._onGeolocationUpdate(position.coords);
    }, 1000), function() {
      self._setStateFailure();
    }, {
      enableHighAccuracy: true
    });
    this.on('destruct', function() {
      navigator.geolocation.clearWatch(this._watchId);
    });
  },

  /**
   * @param {Boolean} state
   */
  setKeepSelection: function(state) {
    this._keepSelection = state;
  },

  /**
   * @returns {String}
   */
  getStateGeo: function() {
    return this._stateGeo;
  },

  /**
   * @param {Coordinates} coords
   */
  _onGeolocationUpdate: function(coords) {
    if (null === this._lookupCoordinatesDeferred) {
      var self = this;
      this._lookupCoordinatesDeferred = this._lookupCoordinates(coords.latitude, coords.longitude, coords.accuracy)
        .done(function(venueList) {
          self._setStateSuccess(venueList);
        })
        .fail(function() {
          self._setStateFailure();
        })
        .always(function() {
          self._lookupCoordinatesDeferred = null;
        });
    }
  },

  /**
   * @param {Number} lat
   * @param {Number} lon
   * @param {Number} radius
   * @return {Deferred}
   */
  _lookupCoordinates: function(lat, lon, radius) {
    var deferred = $.Deferred();
    this.ajax('getVenuesByCoordinates', {lat: lat, lon: lon, radius: radius}, {
      success: function(venueList) {
        if (venueList.length == 0) {
          deferred.reject();
        } else {
          deferred.resolve(venueList);
        }
      }, error: function() {
        deferred.reject();
      }
    }).fail(function(xhr, textStatus) {
      if (xhr.status === 0) {
        // Request aborted/interruped - will be ignored by CM_App.ajax(), so we cover it here
        deferred.reject();
      }
    });
    return deferred;
  },

  _setStateWaiting: function() {
    window.clearTimeout(this._waitingTimeoutId);
    this._waitingTimeoutId = this.setTimeout(function() {
      this._setStateFailure();
    }, 1000 * 10);

    this._setState('waiting', []);
  },

  _setStateFailure: function() {
    window.clearTimeout(this._waitingTimeoutId);

    this._setState('failure', []);
  },

  /**
   * @param {Array} venueList
   */
  _setStateSuccess: function(venueList) {
    window.clearTimeout(this._waitingTimeoutId);

    this._setState('success', venueList);
  },

  /**
   * @param {String} state
   * @param {Array} venueList
   */
  _setState: function(state, venueList) {
    var change = (this._stateGeo !== state);
    this._setVenueList(venueList);
    this._stateGeo = state;

    if (change) {
      this.trigger('state-geo-change', state)
    }
  },

  /**
   * @param {Array} venueList
   */
  _setVenueList: function(venueList) {
    var $select = this.getInput();
    var backupOption = $select.find('option:selected')[0];
    var backupValue = backupOption ? parseInt(backupOption.value) : null;
    $select.empty();
    _.each(venueList, function(venue) {
      $select.append($('<option></option>').attr('value', venue.id).text(venue.name));
    });
    if (this._keepSelection && backupOption) {
      if (!_.contains(_.pluck(venueList, 'id'), backupValue)) {
        $select.prepend(backupOption);
      }
      $select.val(backupValue);
    }
    $select.trigger('change');
  }
});
