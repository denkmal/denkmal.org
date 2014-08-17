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
    this.submit('Save_Preview', {handleErrors: false, disableUI: false}).done(function(response) {
      form._injectView(response, function() {
        if (form._preview) {
          form._preview.replaceWithHtml(this.$el);
        } else {
          form.$el.append(this.$el);
        }
        form._preview = this;
      });
    }).fail(function() {
      if (form._preview) {
        form._preview.remove();
        form._preview = null;
      }
    });
  }
});
