/**
 * @class Admin_Page_UserInvites
 * @extends Admin_Page_Abstract
 */
var Admin_Page_UserInvites = Admin_Page_Abstract.extend({

  /** @type String */
  _class: 'Admin_Page_UserInvites',

  childrenEvents: {
    'Admin_Form_UserInvite success.Create': function(form) {
      this.reload();
    }
  }
});
