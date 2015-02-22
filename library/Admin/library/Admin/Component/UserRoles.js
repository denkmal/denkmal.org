/**
 * @class Admin_Component_UserRoles
 * @extends Admin_Component_Abstract
 */
var Admin_Component_UserRoles = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_UserRoles',

  'events': {
    'click .toggleRole': function(event) {
      var $checkbox = $(event.currentTarget);
      var role = $checkbox.closest('.roleList-item').data('role');
      var state = $checkbox.prop('checked');
      this.toggleRole(role, state);
    }
  },

  /**
   * @param {Number} role
   * @param {Boolean} state
   */
  toggleRole: function(role, state) {
    this.ajaxModal('setRole', {role: role, state: state});
  }
});
