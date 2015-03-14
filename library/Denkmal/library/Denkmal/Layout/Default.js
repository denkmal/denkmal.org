/**
 * @class Denkmal_Layout_Default
 * @extends CM_Layout_Abstract
 */
var Denkmal_Layout_Default = CM_Layout_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Layout_Default',

  childrenEvents: {
    'Denkmal_Page_Events ready': function(view) {
      var self = this;
      view.bindJquery(view.$('.scrollable'), 'scroll', function(event) {
        self._onContentScroll($(event.currentTarget));
      });

      this._onContentScroll(view.$('.active .scrollable'));
      this._setWeekMenuVisible(true);
    },

    'Denkmal_Page_Events swipe': function(view) {
      this._onContentScroll(view.$('.active .scrollable'));
    },

    'Denkmal_Page_Events destruct': function(view) {
      this.findChild('Denkmal_Component_HeaderBar').toggleMenu(false);
      this._setWeekMenuVisible(false);
    },

    'Denkmal_Page_Now ready': function() {
      this._setChatIndication(false);
    }
  },

  ready: function() {
    this.bindStream('global-internal', cm.model.types.CM_Model_StreamChannel_Message, 'message-create', function(message) {
      var page = this.findPage();
      var isChat = page && page.hasClass('Denkmal_Page_Now');
      if (!isChat) {
        this._setChatIndication(true);
      }
    });
  },

  /**
   * @param {Boolean} state
   */
  _setChatIndication: function(state) {
    this.findChild('Denkmal_Component_HeaderBar').setChatIndication(state);
  },

  /**
   * @param {Boolean} state
   */
  _setWeekMenuVisible: function(state) {
    this.findChild('Denkmal_Component_HeaderBar').setWeekMenuVisible(state);
  },

  /**
   * @param {jQuery} $scrollable
   */
  _onContentScroll: function($scrollable) {
    var scrolledNotTop = $scrollable.scrollTop() > 20;
    this.$el.toggleClass('scrolledNotTop', scrolledNotTop);
  }
});
