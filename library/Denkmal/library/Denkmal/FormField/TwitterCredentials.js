/**
 * @class Denkmal_FormField_TwitterCredentials
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_TwitterCredentials = CM_FormField_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_FormField_TwitterCredentials',

  /**
   * @returns {Object}
   */
  getValue: function() {
    return {
      consumerKey: this.$('input[name*=consumerKey]').val(),
      consumerSecret: this.$('input[name*=consumerSecret]').val(),
      accessToken: this.$('input[name*=accessToken]').val(),
      accessTokenSecret: this.$('input[name*=accessTokenSecret]').val()
    };
  },

  /**
   * @param {Object} data
   */
  setValue: function(data) {
    this.$('select[name*=consumerKey]').val(data.consumerKey);
    this.$('select[name*=consumerSecret]').val(data.consumerSecret);
    this.$('select[name*=accessToken]').val(data.accessToken);
    this.$('select[name*=accessTokenSecret]').val(data.accessTokenSecret);
  },

  isEmpty: function(value) {
    return (value['consumerKey'] === '' && value['consumerSecret'] === '');
  }
});
