/**
 * @class Denkmal_Form_EventAdd
 * @extends CM_Form_Abstract
 */
var Denkmal_Form_EventAdd = CM_Form_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Form_EventAdd',

  /** @type Denkmal_Component_EventPreview|Null */
  _preview: null,

  childrenEvents: {
    'Denkmal_FormField_Venue add': function(view, data) {
      var nextField = this.getField('date');
      if (data.new) {
        this.$('.venueDetails').show();
        nextField = this.getField('venueAddress');
      }
      this.setTimeout(function() {
        nextField.setFocus();
      }, 50);
    },
    'Denkmal_FormField_Venue delete': function() {
      this.$('.venueDetails').hide();
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
    this.submit('Preview', {handleErrors: false, disableUI: false})
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
