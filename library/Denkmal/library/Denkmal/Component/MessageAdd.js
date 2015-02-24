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
      this._setStateActive(true);
    },
    'click .hideForm': function() {
      this._setStateActive(false);
    },
    'click .retryLocation': function() {
      this._getVenueField().detectLocation();
    }
  },

  childrenEvents: {
    'Denkmal_Form_Message success': function() {
      this._setStateActive(false);
    },
    'Denkmal_FormField_Tags toggleSpecial.text': function(view, data) {
      this.toggleText(data.state);
    },
    'Denkmal_FormField_Tags toggleSpecial.image': function(view, data) {
      this.toggleImage(data.state);
    },
    'Denkmal_FormField_VenueNearby waiting': function() {
      if (!this._getStateActiveLocked()) {
        this._setStateGeo('waiting');
        this._toggleSubmitEnabled(false);
      }
    },
    'Denkmal_FormField_VenueNearby failure': function() {
      if (!this._getStateActiveLocked()) {
        this._setStateGeo('failure');
        this._toggleSubmitEnabled(false);
      }
    },
    'Denkmal_FormField_VenueNearby success': function() {
      this._setStateGeo('success');
      this._toggleSubmitEnabled(true);
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
    if (!state) {
      this._getForm().reset();
    }
    this._stateActive = state;
    this._setStateActiveLocked();
  },

  /**
   * @returns {Boolean}
   */
  _getStateActiveLocked: function() {
    return this._stateActiveLocked;
  },

  _setStateActiveLocked: function() {
    var state = this._getStateActive() && ('success' === this._getStateGeo());
    this._getVenueField().setKeepSelection(state);
    this._stateActiveLocked = state;
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
    var classes = this.el.className.split(' ').filter(function(c) {
      return c.lastIndexOf('state-geo-', 0) !== 0;
    });
    classes.push('state-geo-' + state);
    this.el.className = $.trim(classes.join(' '));
    this._stateGeo = state;
    this._setStateActiveLocked();
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

  /**
   * @param {Boolean} state
   */
  _toggleSubmitEnabled: function(state) {
    this._getForm().$('button[type="submit"]').prop('disabled', !state);
  }
});
