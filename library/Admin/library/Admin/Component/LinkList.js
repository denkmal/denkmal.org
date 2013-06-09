/**
 * @class Admin_Component_LinkList
 * @extends Admin_Component_Abstract
 */
var Admin_Component_LinkList = Admin_Component_Abstract.extend({

	/** @type String */
	_class: 'Admin_Component_LinkList',

	events: {
		'click .delete': function(event) {
			var id = $(event.currentTarget).closest('.link').data('id');
			this.delete(id);
			return false;
		}
	},

	/**
	 * @param {Number} id
	 */
	delete: function(id) {
		this.ajax('delete', {id: id});
	}
});
