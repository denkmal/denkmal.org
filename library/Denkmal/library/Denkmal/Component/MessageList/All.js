/**
 * @class Denkmal_Component_MessageList_All
 * @extends Denkmal_Component_MessageList_Abstract
 */
var Denkmal_Component_MessageList_All = Denkmal_Component_MessageList_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_MessageList_All',

  ready: function() {
    this.bindStream('global-internal', cm.model.types.CM_Model_StreamChannel_Message, 'message-create', function(message) {
      console.log('message', message);
    });
  }
});
