/**
 * @class Denkmal_Component_EventAdd
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventAdd = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_EventAdd',

	childrenEvents: {
		'Denkmal_Form_EventAdd change': function() {
			var form = this.findChild('Denkmal_Form_EventAdd');
			var description = form.getField('title').$('input').val() + ' ' + form.getField('artists').$('input').val() + ' ' + form.getField('genres').$('input').val() + ' ' + form.getField('urls').$('input').val()
			var data = {
				'description': description,
				'from': form.getField('fromTime').$('input').val(),
				'starred': false,
				'venue': form.getField('venue').getValue(),
				'address': form.getField('venueAddress').$('input').val(),
				'url': form.getField('venueUrl').$('input').val()
			};
			this.findChild('Denkmal_Component_Event').reload({data: data});
		}
	},

	ready: function() {
		var eventAddForm = this.findChild('Denkmal_Form_EventAdd');
		_.each(eventAddForm.getChildren('CM_FormField_Text'), function(field) {
			field.enableTriggerChange();
		});
	}
});
