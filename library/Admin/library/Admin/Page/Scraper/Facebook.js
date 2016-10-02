/**
 * @class Admin_Page_Scraper_Facebook
 * @extends Admin_Page_Abstract
 */
var Admin_Page_Scraper_Facebook = Admin_Page_Abstract.extend({

  /** @type {String} */
  _class: 'Admin_Page_Scraper_Facebook',

  events: {
    'click .removeFacebookPage': function(event) {
      var facebookPageId = $(event.currentTarget).closest('[data-facebookpage-id]').data('facebookpage-id');
      return this.removeFacebookPage(facebookPageId);
    }
  },

  ready: function() {
    this.$('.toggleNext .toggleNext-excluded').on('click', function(event) {
      event.stopPropagation();
    });
  },

  /**
   * @param {Number} facebookPageId
   * @returns {Promise}
   */
  removeFacebookPage: function(facebookPageId) {
    return this.ajax('removeFacebookPage', {facebookPage: facebookPageId});
  }

});
