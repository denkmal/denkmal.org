/**
 * @class Denkmal_Page_Events
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Events = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Events',

  /** @type SwipeCarousel */
  _carousel: null,

  /** @type Boolean */
  _floatboxFullscreen: false,

  _stateParams: ['date', 'event'],

  events: {
    'swipeCarousel-change .swipeCarousel': function(event, data) {
      var pushHistoryState = !data.skipPushHistoryState;
      this._onShowPane($(data.element), pushHistoryState);
    }
  },

  ready: function() {
    var $carousel = this.$('.swipeCarousel');
    this._carousel = new SwipeCarousel($carousel);
    this._carousel.init();

    var self = this;
    this.on('destruct', function() {
      self._carousel.destroy();
    });

    this._initFloatboxMediaQuery();
  },

  _initFloatboxMediaQuery: function() {
    var self = this;
    var mediaQueryLarge = {
      match: function() {
        self._changeFloatboxFullscreen(false);
      }
    };
    var mediaQuerySmall = {
      match: function() {
        self._changeFloatboxFullscreen(true);
      }
    };
    enquire.register('(min-width: 600px)', mediaQueryLarge);
    enquire.register('(max-width: 599px)', mediaQuerySmall);
    this.on('destruct', function() {
      enquire.unregister('(min-width: 600px)', mediaQueryLarge);
      enquire.unregister('(max-width: 599px)', mediaQuerySmall);
    });
  },

  _changeFloatboxFullscreen: function(state) {
    this._floatboxFullscreen = state;
    $('.floatbox').toggleClass('fullscreen', state);
  },

  /**
   * @param {String} date
   */
  showPane: function(date) {
    var $element = this.$('.dateList > .dateList-item[data-date="' + date + '"]');
    if (!$element.length) {
      throw new Error('Cannot find date list pane for date `' + date + '`');
    }
    this._carousel.showPane($element.index(), {skipPushHistoryState: true}, !Modernizr.touchevents);
    this._onShowPane($element);
  },

  /**
   * @param {String } date
   * @returns {boolean}
   * @private
   */
  _hasPane: function(date) {
    var $element = this.$('.dateList > .dateList-item[data-date="' + date + '"]');
    return $element.length > 0;
  },

  /**
   * @param {jQuery} $element
   * @param {Boolean} [pushHistoryState]
   */
  _onShowPane: function($element, pushHistoryState) {
    var title = $element.data('title');
    var url = $element.data('url');
    var date = $element.data('date');
    var menuEntryHash = $element.data('menu-hash');

    cm.getDocument()._updateTitle(title);
    cm.getDocument()._activateMenuEntries([menuEntryHash]);

    if (pushHistoryState) {
      this._onShowPaneSetUrl(url, date);
    }

    this.trigger('swipe', $element);
  },

  /**
   * @param {String} url
   * @param {String} date
   */
  _onShowPaneSetUrl: function(url, date) {
    var nextState = {date: date};
    if (!_.isEqual(nextState, this.getState())) {
      cm.router.pushState(url);
      this.setState(nextState);
    }
  },

  /**
   * @param {String} eventId
   * @returns {Denkmal_Component_EventDetails}
   * @private
   */
  _getEventDetailsComponent: function(eventId) {
    eventId = '' + eventId;
    var eventComponentList = {};
    _.each(this.getChildren('Denkmal_Component_EventList'), function(eventListCmp) {
      _.each(eventListCmp.getChildren('Denkmal_Component_Event'), function(eventCmp) {
        eventComponentList['' + eventCmp.getEvent().id] = eventCmp.getChild('Denkmal_Component_EventDetails');
      });
    });
    var eventComponent = eventComponentList[eventId];
    if (!eventComponent) {
      throw new Error('Cannot find event component for id `' + eventId + '`');
    }
    return eventComponent;
  },

  /**
   * @param {String} eventId
   * @param {String} date
   */
  showEventDetails: function(eventId, date) {
    var eventComponent = this._getEventDetailsComponent(eventId);
    eventComponent.popOut({'fullscreen': this._floatboxFullscreen});
  },

  hideEventDetails: function() {
    $('.floatbox').floatbox('close')
  },

  /**
   * @param {Boolean} state
   */
  _changeState: function(state) {
    var date = state['date'];
    if (!date) {
      date = this.$('.dateList > .dateList-item:first').data('date');
      this.setState({date: date});
    }
    if (!this._hasPane(date)) {
      return false;
    }

    this.showPane(date);

    var event = state['event'];
    if (event) {
      this.showEventDetails(event, date);
    } else {
      this.hideEventDetails();
    }
  }
});
