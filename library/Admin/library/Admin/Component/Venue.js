/**
 * @class Admin_Component_Venue
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Venue = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Venue',

  events: {
    'toggleNext-open .venue-content': function(event, data) {
      $(document).scrollTo(data['toggler']);
    }
  },

  childrenEvents: {
    'Admin_Form_VenueMerge success': function() {
      this.remove();
    }
  }
});
