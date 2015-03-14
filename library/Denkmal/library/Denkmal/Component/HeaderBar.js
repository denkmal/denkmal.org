/**
 * @class Denkmal_Component_HeaderBar
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_HeaderBar = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_HeaderBar',

  /** @type Boolean */
  narrow: null,

  events: {
    'click .menu.dates .navButton': function() {
      if (this.narrow) {
        var state = !this.$el.hasClass('state-weekdayMenu');
        this.setWeekdayMenuVisible(state);
      }
    }
  },

  ready: function() {
    var self = this;
    var handlers = {
      match: function() {
        self.narrow = true;
      },
      unmatch: function() {
        self.narrow = false;
        self.setWeekdayMenuVisible(false);
      }
    };

    enquire.register('(max-width: 580px)', handlers);
    this.on('destruct', function() {
      enquire.unregister('(max-width: 580px)', handlers);
    });
  },

  /**
   * @param {Boolean} state
   */
  setChatIndication: function(state) {
    this.$('.nowButton .indication-chat').toggleClass('active', state);
  },

  /**
   * @param {Boolean} state
   */
  setWeekdayVisible: function(state) {
    this.$el.toggleClass('state-weekday', state);
  },

  /**
   * @param {Boolean} state
   */
  setWeekdayMenuVisible: function(state) {
    if (state) {
      this.$el.toggleModal(function(state) {
        $(this).toggleClass('state-weekdayMenu', state);
      });
    } else {
      this.$el.toggleModalClose();
    }
  }
});
