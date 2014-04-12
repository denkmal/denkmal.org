/**
 * @class Admin_Component_EventList_Abstract
 * @extends Admin_Component_Abstract
 */
var Admin_Component_EventList_Abstract = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_EventList_Abstract',

  childrenEvents: {
    'Admin_Form_Event success.Delete': function() {
      this.reload();
    }
  }
});
