/**
 * @class Admin_Component_Link
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Link = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Link',

  events: {
    'toggleNext-open .link-content': function(event, data) {
      $(document).scrollTo(data['toggler']);
    }
  }
});
