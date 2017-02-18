/**
 * @class Admin_Form_Event
 * @extends CM_Form_Abstract
 */
var Admin_Form_Event = CM_Form_Abstract.extend({

  /** @type String */
  _class: 'Admin_Form_Event',

  /** @type Denkmal_Component_EventPreview|Null */
  _preview: null,

  events: {
    'keydown textarea[name="description"]': function(event) {
      if (event.which == cm.keyCode.ENTER) {
        this.submit('Save');
      }
    },
    'click .deleteEvent': 'deleteEvent'
  },

  ready: function() {
    _.each(this.getChildren('CM_FormField_Text'), function(field) {
      field.enableTriggerChangeOnInput();
    });

    this.on('change', _.debounce(this.renderPreview, 100));
  },

  renderPreview: function() {
    var form = this;
    this._submitOnly('Preview', false)
      .then(function(response) {
        var preview = form._injectView(response);
        if (form._preview) {
          form._preview.replaceWithHtml(preview.$el);
        } else {
          form.$el.append(preview.$el);
        }
        form._preview = preview;
        preview._ready();
      })
      .catch(function(error) {
        if (form._preview) {
          form._preview.remove();
          form._preview = null;
        }
      });
  },

  /**
   * @returns {Promise}
   */
  deleteEvent: function() {
    var self = this;
    return this.ajax('deleteEvent')
      .then(function() {
        self.trigger('event:deleted');
      });
  }
});
