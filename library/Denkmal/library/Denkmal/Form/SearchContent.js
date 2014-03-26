/**
 * @class Denkmal_Form_SearchContent
 * @extends CM_Form_Abstract
 */
var Denkmal_Form_SearchContent = CM_Form_Abstract.extend({
  _class: 'Denkmal_Form_SearchContent',

  setFocus: function() {
    this.getField('term').setFocus();
  }
});
