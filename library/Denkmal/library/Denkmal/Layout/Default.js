/**
 * @class Denkmal_Layout_Default
 * @extends CM_Layout_Abstract
 */
var Denkmal_Layout_Default = CM_Layout_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Layout_Default',

  childrenEvents: {
    'Denkmal_Page_Events ready': function(view) {
      var $layout = this.$el;
      var $pageScrollables = view.$('.scrollable');

      var onScroll = function() {
        var scrolledNotTop = view.$('.active .scrollable').scrollTop() > 20;
        $layout.toggleClass('scrolledNotTop', scrolledNotTop);
      };

      $pageScrollables.bind('scroll', onScroll);
      view.on('destruct', function() {
        $pageScrollables.unbind('scroll', onScroll);
      });
      view.on('swipe', function() {
        onScroll();
      });
      onScroll();

      $layout.addClass('menu-visible');
    },

    'Denkmal_Page_Events destruct': function(view) {
      var $layout = this.$el;
      $layout.removeClass('menu-visible');

      var headerBar = cm.findView('Denkmal_Component_HeaderBar');
      headerBar.toggleMenu(false);
    },

    'Denkmal_Page_Now ready': function() {
      this.setChatIndication(false);
    }
  },

  ready: function() {
    this.bindStream('global-internal', cm.model.types.CM_Model_StreamChannel_Message, 'message-create', function(message) {
      var page = cm.getLayout().findPage();
      var isChat = page && page.hasClass('Denkmal_Page_Now');
      if (!isChat) {
        this.setChatIndication(true);
      }
    });
  },

  /**
   * @param {Boolean} state
   */
  setChatIndication: function(state) {
    console.log('indication', state);
  }
});
