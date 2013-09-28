/**
 * @class Admin_Component_VenueAliasList
 * @extends Admin_Component_Abstract
 */
var Admin_Component_VenueAliasList = Admin_Component_Abstract.extend({

	/** @type String */
	_class: 'Admin_Component_VenueAliasList',

	events: {
		'click .deleteAlias': function(event) {
			var id = $(event.currentTarget).closest('li').data('id');
			this.delete(id);
			return false;
		}
	},

	delete: function(id){
		this.ajax('delete', {id: id});
	}
});
