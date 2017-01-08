/**
 * @class Admin_Form_Venue
 * @extends CM_Form_Abstract
 */
var Admin_Form_Venue = CM_Form_Abstract.extend({
  _class: 'Admin_Form_Venue',

  events: {
    'click .deleteVenue': 'deleteVenue'
  },

  /**
   * @returns {Promise}
   */
  deleteVenue: function() {
    var self = this;
    return this.ajax('deleteVenue')
      .then(function() {
        self.trigger('venue:deleted');
      });
  }
});
