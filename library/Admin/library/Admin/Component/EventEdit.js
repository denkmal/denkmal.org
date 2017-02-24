/**
 * @class Admin_Component_EventEdit
 * @extends Admin_Component_Abstract
 */
var Admin_Component_EventEdit = Admin_Component_Abstract.extend({

  /** @type {String} */
  _class: 'Admin_Component_EventEdit',

  events: {
    'click .selectSong': function(event) {
      var $song = $(event.currentTarget).closest('.selectSong');
      this.findChild('Admin_Form_Event').getField('song').setValue({'id': $song.data('id'), 'name': $song.data('label')});
    }
  }
});
