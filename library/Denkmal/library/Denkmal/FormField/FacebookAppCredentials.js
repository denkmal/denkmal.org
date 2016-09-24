/**
 * @class Denkmal_FormField_FacebookAppCredentials
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_FacebookAppCredentials = CM_FormField_Abstract.extend({

  /** @type {String} */
  _class: 'Denkmal_FormField_FacebookAppCredentials',

  /**
   * @returns {Object}
   */
  getValue: function() {
    return {
      id: this.$('input[name*=id]').val(),
      secret: this.$('input[name*=secret]').val()
    };
  },

  /**
   * @param {Object} data
   */
  setValue: function(data) {
    this.$('select[name*=id]').val(data.id);
    this.$('select[name*=secret]').val(data.secret);
  },

  isEmpty: function(value) {
    return (value['id'] === '' && value['secret'] === '');
  }
});
