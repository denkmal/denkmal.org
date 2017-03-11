/**
 * @class Denkmal_Component_EventAdd
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventAdd = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_EventAdd',

  events: {
    'click .addSimilar': 'addSimilar'
  },

  childrenEvents: {
    'Denkmal_Form_EventAdd success.Create': function() {
      this.$('.Denkmal_Form_EventAdd .infoWrapper').hide();
      this.$('.Denkmal_Form_EventAdd .formWrapper').slideUp();
      this.$('.formSuccess').slideDown();
    }
  },

  addSimilar: function() {
    var fieldsToEmpty = ['title', 'artists', 'genres', 'link'];
    var form = this.findChild('Denkmal_Form_EventAdd');
    _.each(fieldsToEmpty, function(fieldToEmpty) {
      form.getField(fieldToEmpty).setValue('');
    });

    form.removePreview();

    this.$('.Denkmal_Form_EventAdd .infoWrapper').show();
    this.$('.Denkmal_Form_EventAdd .formWrapper').slideDown();
    this.$('.formSuccess').slideUp();
  }
});
