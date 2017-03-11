/**
 * @class Denkmal_Component_EventList
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventList = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_EventList',

  events: {
    'click .showEventDetails': function(event) {
      this._showEventDetails(this.$(event.currentTarget));
    }
  },

  ready: function() {
    [].forEach.call(this.el.querySelectorAll('img[data-src]'), function(img) {
      img.setAttribute('src', img.getAttribute('data-src'));
      img.onload = function() {
        img.removeAttribute('data-src');
      };
    });
  },

  _showEventDetails: function($wrapper) {
    $wrapper.height($wrapper.height());
    var $event = $wrapper.find('.Denkmal_Component_Event').floatbox({'fullscreen': true});

    $event.on('floatbox-close', function() {
      $wrapper.height('auto');
    });
  }
});
