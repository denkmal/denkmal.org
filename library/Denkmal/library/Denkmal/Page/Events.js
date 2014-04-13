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
      var nextState = {date: $(data.element).data('date')};
      if (this.hasStateParams() && !_.isEqual(nextState, this.getState())) {
        this.setState(nextState);
        cm.router.pushState($(data.element).data('url'));
      }
    }
  },

  ready: function() {
    var self = this;
    var $carousel = this.$('.swipeCarousel');
    $carousel.removeClass('beforeload');
    this._carousel = new Carousel(".swipeCarousel");
    this._carousel.init();

    this.bindJquery($(window), 'keydown', function(event) {
      if (event.which === cm.keyCode.LEFT) {
        this._carousel.prev();
      }
      if (event.which === cm.keyCode.RIGHT) {
        this._carousel.next();
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
      this._carousel.showPane($element.index());
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
    var menuEntryHash = $element.data('menu-entry-hash');

    cm.findView()._onPageSetup(this, title, url, [menuEntryHash]);
    this.trigger('swipe', $element);
  },

  _changeState: function(state) {
    if (state['date']) {
      return this.showPane(state['date']);
    }
  }
});
