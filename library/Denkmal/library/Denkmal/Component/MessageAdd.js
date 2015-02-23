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
    'Denkmal_Form_Message success': function(form) {
      this.toggleActive(false);
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
  }
});
