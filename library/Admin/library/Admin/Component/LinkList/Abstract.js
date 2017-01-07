/**
 * @class Admin_Component_LinkList_Abstract
 * @extends Admin_Component_Abstract
 */
var Admin_Component_LinkList_Abstract = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_LinkList_Abstract',

  childrenEvents: {
    'Admin_Form_Link link:deleted': function() {
      this.reload();
    }
  }
});
