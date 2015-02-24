/**
 * @class Denkmal_Component_MessageAdd
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_MessageAdd = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_MessageAdd',

  events: {
    'click .showForm': function() {
      this.toggleActive(true);
    },
    'click .hideForm': function() {
      this.toggleActive(false);
    }
  },

  childrenEvents: {
    'Denkmal_FormField_Tags toggleSpecial.text': function(view, data) {
      this.toggleText(data.state);
    },
    'Denkmal_FormField_Tags toggleSpecial.image': function(view, data) {
      this.toggleImage(data.state);
    },
    'Denkmal_FormField_VenueNearby waiting': function() {
      this._setStateGeo('waiting');
      this._toggleSubmitEnabled(false);
    },
    'Denkmal_FormField_VenueNearby failure': function() {
      this._setStateGeo('failure');
      this._toggleSubmitEnabled(false);
    },
    'Denkmal_FormField_VenueNearby success': function() {
      this._setStateGeo('success');
      this._toggleSubmitEnabled(true);
    }
  },

  /**
   * @param {Boolean} state
   */
  toggleActive: function(state) {
    this.$el.toggleClass('state-active', state);
    if (!state) {
      this.findChild('Denkmal_Form_Message').reset();
    }
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
   * @param {String} state
   */
  _setStateGeo: function(state) {
    var classes = this.el.className.split(' ').filter(function(c) {
      return c.lastIndexOf('state-geo-', 0) !== 0;
    });
    classes.push('state-geo-' + state);
    this.el.className = $.trim(classes.join(' '));
  },

  /**
   * @param {Boolean} state
   */
  _toggleSubmitEnabled: function(state) {
    this.findChild('Denkmal_Form_Message').$('button[type="submit"]').prop('disabled', !state);
  }
});
