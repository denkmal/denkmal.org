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

  /** @type {Promise} */
  _lookupCoordinatesPromise: null,

  events: {
    'change select': function(event) {
      var select = event.currentTarget;
      if ('' === select.value && select.options.length > 0) {
        /**
         * Workaround for iOS bug:
         * When the select is opened (UI appears), and all options except the selected one are removed,
         * and one of the removed options is chosen, then the select's "value" is an empty string.
         * This would eventually make "_setVenueList()" not detect a selected option and therefore remove all entries.
         */
        select.value = select.options[0].value;
      }
    }
  },

  initialize: function() {
    CM_FormField_Abstract.prototype.initialize.call(this);

    this._watchId = null;
    this._waitingTimeoutId = null;
    this._keepSelection = false;
    this._stateGeo = null;
  },

  ready: function() {
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
    if (null === this._lookupCoordinatesPromise) {
      var self = this;
      this._lookupCoordinatesPromise = this._lookupCoordinates(coords.latitude, coords.longitude, coords.accuracy)
        .then(function(venueList) {
          self._setStateSuccess(venueList);
        })
        .catch(function() {
          self._setStateFailure();
        })
        .finally(function() {
          self._lookupCoordinatesPromise = null;
        });
    }
  },

  /**
   * @param {Number} lat
   * @param {Number} lon
   * @param {Number} radius
   * @return Promise
   */
  _lookupCoordinates: function(lat, lon, radius) {
    return this.ajax('getVenuesByCoordinates', {lat: lat, lon: lon, radius: radius})
      .then(function(venueList) {
        if (venueList.length == 0) {
          throw new Error('Empty venue list received.');
        }
        return venueList;
      });
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
