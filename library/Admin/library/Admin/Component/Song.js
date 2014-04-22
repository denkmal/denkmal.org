/**
 * @class Admin_Component_Song
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Song = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Song',

  events: {
    'toggleNext-open .song-content': function(event, data) {
      $(document).scrollTo(data['toggler']);
    }
  }
});
