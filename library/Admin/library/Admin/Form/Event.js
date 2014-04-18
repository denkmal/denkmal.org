/**
 * @class Admin_Form_Event
 * @extends CM_Form_Abstract
 */
var Admin_Form_Event = CM_Form_Abstract.extend({

  /** @type String */
  _class: 'Admin_Form_Event',

  events: {
    'keydown textarea[name="description"]': function(event) {
      if (event.which == cm.keyCode.ENTER) {
        this.submit('Save');
      }
    }
  }
});
