/**
 * @class Denkmal_Component_HeaderBar
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_HeaderBar = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_HeaderBar',

  events: {
    'click .menu.dates a': function() {
      var state = !this.el.hasAttribute('data-weekday-menu');
      this.setWeekdayMenuVisible(state);
    }
  },

  /**
   * @param {Boolean} state
   */
  setWeekdayMenuVisible: function(state) {
    var callback = function(state) {
      $(this).attr('data-weekday-menu', state ? '' : null);
    };
    if (state) {
      this.$el.toggleModal('open', callback);
    } else {
      this.$el.toggleModal('close', callback);
    }
  },

  /**
   * @param {Boolean} state
   */
  setNavigationIndicationVisible: function(state) {
    this.$el.attr('data-navigation-indication', state ? '' : null);
  }
});
