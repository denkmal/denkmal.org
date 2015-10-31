/**
 * @class Denkmal_Page_Events
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Events = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Events',

  /** @type SwipeCarousel */
  _carousel: null,

  _stateParams: ['date'],

  events: {
    'swipeCarousel-change .swipeCarousel': function(event, data) {
      var delaySetUrl = !data.immediateSetUrl;
      this._onShowPane($(data.element), delaySetUrl);
    }
  },

  childrenEvents: {
    'Denkmal_Component_Event toggleDetails-open': function(view) {
      view.$el.closest('.scrollable').scrollTo(view.$el);
    }
  },

  ready: function() {
    this._onShowPaneSetUrlDelayed = _.debounce(this._onShowPaneSetUrl, 2000);

    var $carousel = this.$('.swipeCarousel');
    this._carousel = new SwipeCarousel($carousel);
    this._carousel.init();

    var self = this;
    this.on('destruct', function() {
      self._carousel.destroy();
    });

    this.on('swipe', function() {
      _.each(this.getChildren('Denkmal_Component_EventList'), function(eventListView) {
        eventListView.closeAllEvents();
      });
    });
  },

  /**
   * @param {String} date
   * @returns Boolean
   */
  showPane: function(date) {
    var $element = this.$('.dateList > .date[data-date="' + date + '"]');
    if ($element.length) {
      this._carousel.showPane($element.index(), {immediateSetUrl: true}, !Modernizr.touchevents);
      this._onShowPane($element);
      return true;
    } else {
      return false;
    }
  },

  /**
   * @param {jQuery} $element
   * @param {Boolean} [delaySetUrl]
   */
  _onShowPane: function($element, delaySetUrl) {
    var title = $element.data('title');
    var url = $element.data('url');
    var date = $element.data('date');
    var menuEntryHash = $element.data('menu-hash');

    cm.getLayout()._onPageSetup(title, [menuEntryHash]);

    if (delaySetUrl) {
      this._onShowPaneSetUrlDelayed(url, date);
    } else {
      this._onShowPaneSetUrl(url, date);
    }

    this.trigger('swipe', $element);
  },

  /**
   * @param {String} url
   * @param {String} date
   */
  _onShowPaneSetUrl: function(url, date) {
    if (!$.contains(document, this.el)) {
      return; // View has been destroyed in the meantime
    }
    var nextState = {date: date};
    if (!_.isEqual(nextState, this.getState())) {
      cm.router.pushState(url);
      this.setState(nextState);
    }
  },

  _changeState: function(state) {
    var date = state['date'];
    if (!date) {
      date = this.$('.dateList > .date:first').data('date');
      this.setState({date: date});
    }
    return this.showPane(date);
  }
});
