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
    }
  },

  ready: function() {
    _.each(this.getChildren('CM_FormField_Text'), function(field) {
      field.enableTriggerChangeOnInput();
    });

    this.on('change', _.debounce(this.renderPreview, 100));
  },

  renderPreview: function() {
    var form = this;
    this.submit('Save_Preview', {handleErrors: false, disableUI: false})
      .then(function(response) {
        if (!response) {
          /**
           * Form validation failure will resolve Promise with empty response
           * See https://github.com/cargomedia/CM/issues/1837
           */
          throw new Error('Empty preview response');
        }
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
        throw error;
      });
  }
});
