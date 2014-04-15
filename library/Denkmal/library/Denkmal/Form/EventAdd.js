/**
 * @class Denkmal_Form_EventAdd
 * @extends CM_Form_Abstract
 */
var Denkmal_Form_EventAdd = CM_Form_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Form_EventAdd',

  /** @type Denkmal_Component_Event|Null */
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
      field.enableTriggerChange();
    });

    this.on('change', function() {
      this.renderPreview();
    });
  },

  renderPreview: function() {
    var self = this;
    var preview = this.loadComponent('Denkmal_Component_EventPreview', {data: this.getData()}, {
      success: function() {
        if (self._preview) {
          self._preview.replaceWith(this);
        } else {
          self.$el.append(this.$el);
        }
        self._preview = this;
      },
      error: function() {
        if (self._preview) {
          self._preview.remove();
          self._preview = null;
        }
        return false;
      },
      method: 'previewEvent',
      modal: false
    });
  }
});
