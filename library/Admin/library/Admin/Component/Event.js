/**
 * @class Admin_Component_Event
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Event = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Event',

  event: null,

  events: {
    'click .editEvent': function() {
      this.popOutComponent('Admin_Component_EventEdit', {event: this.event});
    }
  }
});
