/**
 * @class Admin_Form_Translation
 * @extends CM_Form_Abstract
 */
var Admin_Form_Translation = CM_Form_Abstract.extend({
  _class: 'Admin_Form_Translation',

  initialContent: null,
  $textarea: null,

  events: {
    'click .resetValue': 'reset',
    'click .copyKeyToValue': 'copyKeyToValue',
    'click .saveForm': 'saveForm'
  },

  ready: function() {
    this.$textarea = this.$('.formField.value textarea');
    this.initialContent = (this.getUnset()) ? null : this.$textarea.val();
    this.reset();

    var handler = this;
    this.$textarea.on('focus', function() {
      handler.$('.clipSlide-handle').click();
      if (!handler.$().hasClass('modified')) {
        handler.$textarea.val(handler.initialContent);
      }
      handler.$().addClass('modified');
    });

    this.bind('success.Save', function() {
      this.initialContent = this.$textarea.val();
      this.$().removeClass('modified');
      this.setUnset(false);
      this.reset();
    });

    this.bind('success.Unset', function() {
      this.initialContent = null;
      this.setUnset(true);
      this.reset();
    });

  },

  getUnset: function() {
    return this.$('.valueWrapper').is('.isUnset');
  },

  /**
   * @param {Boolean} unset
   */
  setUnset: function(unset) {
    this.$('.valueWrapper').toggleClass('isUnset', unset);
  },

  reset: function() {
    if (this.getUnset()) {
      this.$textarea.val('undefined');
    } else {
      this.$textarea.val(this.initialContent);
    }
    this.$().removeClass('modified');
    this.$('.copyKeyToValue').toggle(this.getUnset());
  },

  copyKeyToValue: function() {
    this.$textarea.focus().val(this.$('.key').text());
  },

  saveForm: function() {
    this.$textarea.val($.trim(this.$textarea.val()));

    if ('' != this.$textarea.val()) {
      this.submit('Save');
      return;
    }

    cm.ui.confirm(cm.language.get('You probably don\'t want to set an empty translation, which would mean that no text at all is displayed to the user. Confirm anyway?'), function() {
      this.submit('Save');
    }, this);
  }
});
