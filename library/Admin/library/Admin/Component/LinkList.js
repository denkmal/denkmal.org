/**
 * @class Admin_Component_LinkList
 * @extends Admin_Component_Abstract
 */
var Admin_Component_LinkList = Admin_Component_Abstract.extend({

	/** @type String */
	_class: 'Admin_Component_LinkList',

	events: {
		'clickConfirmed .deleteLink': function(event) {
			var id = $(event.currentTarget).closest('li.link').data('id');
			this.deleteLink(id);
			return false;
		}
	},

	/**
	 * @param {Number} id
	 */
	deleteLink: function(id) {
		this.ajax('deleteLink', {id: id});
	}
});
