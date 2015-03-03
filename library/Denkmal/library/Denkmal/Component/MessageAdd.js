/**
 * @class Denkmal_Component_MessageAdd
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_MessageAdd = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_MessageAdd',

  /** @type {Boolean} */
  _stateActive: null,

  /** @type {Boolean} */
  _stateActiveLocked: null,

  /** @type {String|Null} */
  _stateGeo: null,

  events: {
    'click .showForm': function() {
      /**
       * Delay opening of the form because of an iOS Safari bug:
       * The "click" on the button would lead to a "focus" event on the venue-nearby dropdown (keyboard shows)
       */
      var self = this;
      _.delay(function() {
        self._setStateActive(true);
      }, 10);
    },
    'click .hideForm': function() {
      this._setStateActive(false);
    },
    'click .retryLocation': function() {
      this._getVenueField().detectLocation();
    }
  },

  childrenEvents: {
    'Denkmal_Form_Message success': function(view, messageData) {
      this._setStateActive(false);
    },
    'Denkmal_FormField_Tags toggleSpecial.text': function(view, state) {
      this.toggleText(state);
    },
    'Denkmal_FormField_Tags toggleSpecial.image': function(view, state) {
      this.toggleImage(state);
    },
    'Denkmal_FormField_VenueNearby state-geo-change': function(view, state) {
      if ('success' === state || !this._getStateActiveLocked()) {
        this._setStateGeo(state);
      }
    }
  },

  ready: function() {
    this._stateActive = false;
    this._stateActiveLocked = false;
    this._stateGeo = null;
  },

  /**
   * @param {Boolean} state
   */
  toggleText: function(state) {
    this.$('.form').toggleClass('state-text', state);
  },

  /**
   * @param {Boolean} state
   */
  toggleImage: function(state) {
    this.$('.form').toggleClass('state-image', state);
  },

  /**
   * @returns {Boolean}
   */
  _getStateActive: function() {
    return this._stateActive;
  },

  /**
   * @param {Boolean} state
   */
  _setStateActive: function(state) {
    this.$el.toggleClass('state-active', state);
    this._stateActive = state;

    if (!state) {
      this._getForm().reset();
    }
    this._updateStateActiveLocked();
  },

  /**
   * @returns {Boolean}
   */
  _getStateActiveLocked: function() {
    return this._stateActiveLocked;
  },

  _updateStateActiveLocked: function() {
    var state = this._getStateActive() && ('success' === this._getStateGeo());
    var change = (this._stateActiveLocked !== state);
    this._stateActiveLocked = state;

    if (change) {
      this._getVenueField().setKeepSelection(state);

      if (false === state) {
        this._setStateGeo(this._getVenueField().getStateGeo());
      }
    }
  },

  /**
   * @returns {String|Null}
   */
  _getStateGeo: function() {
    return this._stateGeo;
  },

  /**
   * @param {String} state
   */
  _setStateGeo: function(state) {
    var change = (this._stateGeo !== state);
    var classes = this.el.className.split(' ').filter(function(c) {
      return c.lastIndexOf('state-geo-', 0) !== 0;
    });
    classes.push('state-geo-' + state);
    this.el.className = $.trim(classes.join(' '));
    this._stateGeo = state;

    this._updateStateActiveLocked();
    if (change) {
      this._updateSubmitEnabled();
    }
  },

  /**
   * @returns {Denkmal_Form_Message}
   */
  _getForm: function() {
    return this.getChildren('Denkmal_Form_Message')[0];
  },

  /**
   * @returns {Denkmal_FormField_VenueNearby}
   */
  _getVenueField: function() {
    return this._getForm().getField('venue');
  },

  _updateSubmitEnabled: function() {
    var state = ('success' === this._getStateGeo());
    this._getForm().$('button[type="submit"]').prop('disabled', !state);
  }
});
