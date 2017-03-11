/**
 * @class Denkmal_Layout_Default
 * @extends CM_Layout_Abstract
 */
var Denkmal_Layout_Default = CM_Layout_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Layout_Default',

  /** @type Object|Null */
  region: null,

  appEvents: {
    'navigate': function() {
      this._setNavigationIndicationVisible(false);
    }
  },

  childrenEvents: {
    'Denkmal_Page_Events ready': function(view) {
      this._bindContentScroll(view, view.$('.scrollable'));
      this._onContentScroll(view.$('.active .scrollable'));
    },

    'Denkmal_Page_Events swipe': function(view) {
      this._onContentScroll(view.$('.active .scrollable'));
    },

    'Denkmal_Page_Add ready': function(view) {
      this._bindContentScroll(view, $(document));
      this._onContentScroll($(document));
    }
  },

  /**
   * @param {CM_View_Abstract} view
   * @param {jQuery} $scrollable
   */
  _bindContentScroll: function(view, $scrollable) {
    var self = this;
    view.bindJquery($scrollable, 'scroll', function(event) {
      self._onContentScroll($(event.currentTarget));
    });
  },

  /**
   * @param {jQuery} $scrollable
   */
  _onContentScroll: function($scrollable) {
    this._setNavigationIndicationVisible($scrollable.scrollTop() <= 20);
  },

  /**
   * @param {Boolean} state
   */
  _setNavigationIndicationVisible: function(state) {
    this.findChild('Denkmal_Component_HeaderBar').setNavigationIndicationVisible(state);
  }
});
