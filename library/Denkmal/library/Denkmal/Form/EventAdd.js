/**
 * @class Denkmal_Form_EventAdd
 * @extends CM_Form_Abstract
 */
var Denkmal_Form_EventAdd = CM_Form_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Form_EventAdd',

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
	}
});
