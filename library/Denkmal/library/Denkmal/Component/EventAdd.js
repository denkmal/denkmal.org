/**
 * @class Denkmal_Component_EventAdd
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventAdd = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_EventAdd',

	childrenEvents: {
		'Denkmal_Form_EventAdd change': function() {
			console.log('change-' + new Date().getTime());
		}
	},

	ready: function() {
		var eventAddForm = this.findChild('Denkmal_Form_EventAdd');
		_.each(eventAddForm.getChildren('CM_FormField_Text'), function(field) {
			field.enableTriggerChange();
		});
	}
});
