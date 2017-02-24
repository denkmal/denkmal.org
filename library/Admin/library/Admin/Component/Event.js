/**
 * @class Admin_Component_Event
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Event = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Event',

  _floatbox: null,

  events: {
    'click .editEvent': function() {
      this._floatbox = this.$('.Admin_Component_EventEdit').floatbox();
    }
  },

  childrenEvents: {
    'Admin_Form_Event success.Save': function(form) {
      this._floatbox.floatbox('close');
    },

    'Admin_Form_Event event:deleted': function(form) {
      this._floatbox.floatbox('close');
    }
  }
});
