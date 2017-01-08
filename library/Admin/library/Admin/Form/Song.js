/**
 * @class Admin_Form_Song
 * @extends CM_Form_Abstract
 */
var Admin_Form_Song = CM_Form_Abstract.extend({
  _class: 'Admin_Form_Song',

  events: {
    'click .deleteSong': 'deleteSong'
  },

  childrenEvents: {
    'Denkmal_FormField_FileSong uploadComplete': function(field, files) {
      this._setLabelFromFilename(files[0].name);
    }
  },

  /**
   * @returns {Promise}
   */
  deleteSong: function() {
    var self = this;
    return this.ajax('deleteSong')
      .then(function() {
        self.trigger('song:deleted');
      })
  },

  /**
   * @param {String} filename
   */
  _setLabelFromFilename: function(filename) {
    filename = filename.replace(/\.[^\.]+$/, '');
    this.getField('label').setValue(filename);
  }
});
