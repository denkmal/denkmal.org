/**
 * @class Admin_Form_Song
 * @extends CM_Form_Abstract
 */
var Admin_Form_Song = CM_Form_Abstract.extend({
	_class: 'Admin_Form_Song',

	childrenEvents: {
		'Denkmal_FormField_FileSong uploadComplete': function(field, files) {
			this._setLabelFromFilename(files[0].name);
		}
	},

	/**
	 * @param {String} filename
	 */
	_setLabelFromFilename: function(filename) {
		filename = filename.replace(/\.[^\.]+$/, '');
		this.getField('label').setValue(filename);
	}
});
