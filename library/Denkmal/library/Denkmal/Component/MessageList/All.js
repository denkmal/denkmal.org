/**
 * @class Denkmal_Component_MessageList_All
 * @extends Denkmal_Component_MessageList_Abstract
 */
var Denkmal_Component_MessageList_All = Denkmal_Component_MessageList_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_MessageList_All',

  ready: function() {
    this.bindStream('global-internal', cm.model.types.CM_Model_StreamChannel_Message, 'message-create', function(message) {
      this._addMessage(message);
    });
  },

  /**
   * @param {Object} message
   */
  _addMessage: function(message) {
    this.renderTemplate('template-message', {
      id: message.id,
      created: message.created,
      venue: message.venue.name,
      hasText: message.text !== null,
      text: message.text,
      hasImage: message.image !== null,
      imageUrl: (message.image !== null) ? message.image['url-thumb'] : null
    }).appendTo(this.$('.messageList'));
  }
});
