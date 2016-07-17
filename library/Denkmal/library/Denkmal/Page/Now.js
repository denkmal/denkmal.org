/**
 * @class Denkmal_Page_Now
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Now = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Now',

  /** @type Object */
  venue: null,

  childrenEvents: {
    'Denkmal_Form_Message success': function(view, messageData) {
      this.addMessage(messageData);
    }
  },

  /**
   * @param {Object} messageData
   */
  addMessage: function(messageData) {
    if (this.venue && this.venue.id != messageData.venue.id) {
      return;
    }
    var messageList = this.findChild('Denkmal_Component_MessageList_Abstract');
    if (messageList) {
      messageList.prependMessage(messageData);
    }
  }
});
