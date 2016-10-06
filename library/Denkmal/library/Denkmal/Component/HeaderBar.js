/**
 * @class Denkmal_Component_HeaderBar
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_HeaderBar = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_HeaderBar',

  /** @type Boolean */
  _weekdayWide: null,

  events: {
    'click .menu.dates a': function() {
      if (!this._weekdayWide) {
        var state = !this.el.hasAttribute('data-weekday-menu');
        this.setWeekdayMenuVisible(state);
      }
    }
  },

  ready: function() {
    var self = this;
    var handlers = {
      match: function() {
        self.setWeekdayWide(true);
      },
      unmatch: function() {
        self.setWeekdayWide(false);
      }
    };

    enquire.register('(min-width: 750px)', handlers);
    this.on('destruct', function() {
      enquire.unregister('(min-width: 750px)', handlers);
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
    this.$el.attr('data-weekday', state ? '' : null);
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
  setWeekdayWide: function(state) {
    this._weekdayWide = state;
    this.$el.attr('data-weekday-wide', state ? '' : null);

    if (false == state) {
      this.setWeekdayMenuVisible(false);
    }
  },

  /**
   * @param {Boolean} state
   */
  setNavigationIndicationVisible: function(state) {
    this.$el.attr('data-navigation-indication', state ? '' : null);
  }
});
