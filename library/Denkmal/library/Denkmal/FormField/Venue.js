/**
 * @class Denkmal_FormField_Venue
 * @extends CM_FormField_SuggestOne
 */
var Denkmal_FormField_Venue = CM_FormField_SuggestOne.extend({
	_class: 'Denkmal_FormField_Venue',

	getValue: function() {
		var values = this._$input.select2("data");
		if (!values.length) {
			return null
		}
		return values[0].id;
	}
});
