/**
 * @class Admin_Page_Songs
 * @extends Admin_Page_Abstract
 */
var Admin_Page_Songs = Admin_Page_Abstract.extend({

  /** @type String */
  _class: 'Admin_Page_Songs',

  childrenEvents: {
    'Admin_Form_Song success.Add': function(form) {
      form.reset();
      this.findChild('Admin_Component_SongList_Abstract').reload();
    }
  }
});
