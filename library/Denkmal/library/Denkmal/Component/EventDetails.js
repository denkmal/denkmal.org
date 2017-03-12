/**
 * @class Denkmal_Component_EventDetails
 * @extends Denkmal_Component_Event
 */
var Denkmal_Component_EventDetails = Denkmal_Component_Event.extend({

  /** @type {String} */
  _class: 'Denkmal_Component_EventDetails',

  ready: function() {
    this.bindJquery(this.$el, 'floatbox-open', function() {
      this._loadImages();
    });
    this.bindJquery(this.$el, 'floatbox-close', function() {
      this._showEventList();
    });
  },


  /**
   * @private
   */
  _loadImages: function() {
    this.$('img[data-src]').each(function() {
      var img = this;
      img.setAttribute('src', img.getAttribute('data-src'));
      img.onload = function() {
        img.removeAttribute('data-src');
      };
    });
  },

  /**
   * @private
   */
  _showEventList: function() {
    var href = this.$('.showEventList').attr('href');
    if (location.href !== href) {
      cm.router.route(href);
    }
  }
});
