/**
 * @class Denkmal_Component_EventList
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventList = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_EventList',

  events: {
    'click .showEventDetails': function(event) {
      var href = $(event.currentTarget).data('href');
      _.defer(function() {
        // Defer is required for the click-feedback animation to trigger on Chrome/Androi
        cm.router.route(href);
      });
    }
  }
});
