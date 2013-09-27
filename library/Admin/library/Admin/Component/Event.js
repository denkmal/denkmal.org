/**
 * @class Admin_Component_Event
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Event = Admin_Component_Abstract.extend({

	/** @type String */
	_class: 'Admin_Component_Event',

	events: {
		'click .editEvent': 'toggleEdit'
	},

	toggleEdit: function(){
		this.$('.event-edit').slideToggle('fast');
	}
});
