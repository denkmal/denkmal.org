/**
 * @class Denkmal_Page_Now
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Now = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Now',

  childrenEvents: {
    'Denkmal_Form_Message success': function(view, messageData) {
      this._addMessage(messageData);
    }
  },

  ready: function() {
    this.bindStream('global-internal', cm.model.types.CM_Model_StreamChannel_Message, 'message-create', function(messageData) {
      this._addMessage(messageData);
    });
  },

  /**
   * @param {Object} data
   */
  _addMessage: function(data) {
    console.log('message', data);
    var messageList = this.findChild('Denkmal_Component_MessageList_Abstract');
    if (messageList) {
      messageList.prependMessage(data);
    }
  }
});
