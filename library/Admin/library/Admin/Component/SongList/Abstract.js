/**
 * @class Admin_Component_SongList_Abstract
 * @extends Admin_Component_Abstract
 */
var Admin_Component_SongList_Abstract = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_SongList_Abstract',

  childrenEvents: {
    'Admin_Form_Song success.Delete': function() {
      this.reload();
    }
  }
});
