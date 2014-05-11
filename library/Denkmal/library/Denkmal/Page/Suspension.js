/**
 * @class Denkmal_Page_Suspended
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Suspended = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Suspended',

  childrenEvents: {
    'Denkmal_Component_SongPlayerButton pause': function() {
      this.reload({'autoPlay': false});
    }
  }
});
