/**
 * @class Denkmal_Page_Now
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Now = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Now',

  ready: function() {
    this.bindStream('global-internal', cm.model.types.CM_Model_StreamChannel_Message, 'message-create', function(message) {
      var messageList = this.findChild('Denkmal_Component_MessageList_Abstract');
      if (messageList) {
        messageList.prependMessage(message);
      }
    });
  }
});
