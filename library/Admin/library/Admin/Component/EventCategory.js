/**
 * @class Admin_Component_EventCategory
 * @extends Admin_Component_Abstract
 */
var Admin_Component_EventCategory = Admin_Component_Abstract.extend({

  /** @type {String} */
  _class: 'Admin_Component_EventCategory',

  events: {
    'click .removeGenre': function(event) {
      var genre = $(event.currentTarget).closest('li.genre').data('genre');
      return this.removeGenre(genre);
    }
  },

  /**
   * @param {String} genre
   * @returns {Promise}
   */
  removeGenre: function(genre) {
    return this.ajax('removeGenre', {'genre': genre});
  }
});
