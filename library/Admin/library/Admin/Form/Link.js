/**
 * @class Admin_Form_Link
 * @extends CM_Form_Abstract
 */
var Admin_Form_Link = CM_Form_Abstract.extend({

  /** @type String */
  _class: 'Admin_Form_Link',

  events: {
    'click .deleteLink': 'deleteLink'
  },

  /**
   * @returns {Promise}
   */
  deleteLink: function() {
    var self = this;
    return this.ajax('deleteLink')
      .then(function() {
        self.trigger('link:deleted');
      });
  }
});
