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

  /** @type {Boolean} */
  _keepSelection: null,

  /** @type {String} */
  _stateGeo: null,

  ready: function() {
    this._watchId = null;
    this._timeoutId = null;
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
    this._setState('waiting', []);
  },

  _setStateFailure: function() {
    this._setState('failure', []);
  },

  /**
   * @param {Array} venueList
   */
  _setStateSuccess: function(venueList) {
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
