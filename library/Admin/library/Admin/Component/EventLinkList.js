/**
 * @class Admin_Component_EventLinkList
 * @extends Admin_Component_Abstract
 */
var Admin_Component_EventLinkList = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_EventLinkList',

  events: {
    'click .deleteEventLink': function(event) {
      var id = $(event.currentTarget).closest('li.eventLink').data('id');
      return this.deleteEventLink(id);
    }
  },

  /**
   * @param {String} id
   * @returns {Promise}
   */
  deleteEventLink: function(id) {
    return this.ajax('deleteEventLink', {id: id});
  }
});
