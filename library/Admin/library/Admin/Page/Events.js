/**
 * @class Admin_Page_Events
 * @extends Admin_Page_Abstract
 */
var Admin_Page_Events = Admin_Page_Abstract.extend({

  /** @type String */
  _class: 'Admin_Page_Events',

  childrenEvents: {
    'Admin_Form_Event success.Save': function(form) {
      this.reload();
    },
    'Admin_Form_Event success.Delete': function(form) {
      this.reload();
    },
    'Admin_Form_Event success.Hide': function(form) {
      this.reload();
    },
    'Admin_Form_Event success.Show': function(form) {
      this.reload();
    },
    'Admin_Form_Venue success.Save': function(form) {
      this.reload();
    },
    'Admin_Form_Venue success.Delete': function(form) {
      this.reload();
    }
  }
});
