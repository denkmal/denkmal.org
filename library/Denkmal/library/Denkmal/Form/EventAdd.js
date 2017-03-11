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
    this._submitOnly('Preview', false)
      .then(function(response) {
        var preview = form._injectView(response);
        form.showPreview(preview);
        preview._ready();
      })
      .catch(function(error) {
        form.removePreview();
      });
  },

  removePreview: function() {
    if (this._preview) {
      this._preview.remove();
      this._preview = null;
      this.$el.attr('data-has-preview', null);
    }
  },

  /**
   *
   * @param {Denkmal_Component_EventPreview} previewComponent
   */
  showPreview: function(previewComponent) {
    if (this._preview) {
      this._preview.replaceWithHtml(previewComponent.$el);
    } else {
      this.$('.previewComponent').html(previewComponent.$el);
    }
    this._preview = previewComponent;
    this.$el.attr('data-has-preview', '');
  }
});
