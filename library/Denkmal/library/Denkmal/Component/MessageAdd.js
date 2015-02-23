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

  /**
   * @param {Boolean} state
   */
  toggleActive: function(state) {
    this.$el.toggleClass('state-active', state);
  }
});
