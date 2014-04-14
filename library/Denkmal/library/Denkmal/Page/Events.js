/**
 * @class Denkmal_Page_Events
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Events = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Events',

  /** @type Carousel */
  _carousel: null,

  _stateParams: ['date'],

  events: {
    'swipeCarousel-change .swipeCarousel': function(event, data) {
      this._onShowPane($(data.element));
    },
    'swipeCarousel-change-eventual .swipeCarousel': function(event, data) {
      var nextState = {date: $(data.element).data('date')};
      if (!_.isEqual(nextState, this.getState())) {
        this._onShowPaneSetUrl($(data.element));
        this.setState(nextState);
      }
    }
  },

  ready: function() {
    var self = this;
    var $carousel = this.$('.swipeCarousel');
    $carousel.removeClass('beforeload');
    this._carousel = new Carousel(".swipeCarousel");
    this._carousel.init();

    this.on('destruct', function() {
      self._carousel.destroy();
    });

    this.bindJquery($(window), 'keydown', function(event) {
      if (event.which === cm.keyCode.LEFT) {
        this._carousel.prev(true);
      }
      if (event.which === cm.keyCode.RIGHT) {
        this._carousel.next(true);
      }
    });
  },

  /**
   * @param {String} date
   * @returns Boolean
   */
  showPane: function(date) {
    var $element = this.$('.dateList > .date[data-date="' + date + '"]');
    if ($element.length) {
      this._carousel.showPane($element.index(), true);
      return true;
    } else {
      return false;
    }
  },

  /**
   * @param {jQuery} $element
   */
  _onShowPane: function($element) {
    var title = $element.data('title');
    var url = $element.data('url');
    var menuEntryHash = $element.data('menu-hash');

    cm.findView()._onPageSetup(this, title, url, [menuEntryHash]);
    this.trigger('swipe', $element);
  },

  /**
   * @param {jQuery} $element
   */
  _onShowPaneSetUrl: function($element) {
    var url = $element.data('url');
    cm.router.pushState(url);
  },

  _changeState: function(state) {
    if (state['date']) {
      return this.showPane(state['date']);
    }
  }
});
