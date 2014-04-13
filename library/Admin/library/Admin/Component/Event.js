/**
 * @class Admin_Component_Event
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Event = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Event',

  events: {
    'click .selectSong': function(event) {
      var $song = $(event.currentTarget).closest('.selectSong');
      this.findChild('Admin_Form_Event').getField('song').setValue({'id': $song.attr('data-id'), 'name': $song.attr('data-label')});
    }
  }
});
