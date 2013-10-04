/**
 * @class Admin_Component_SongList_Abstract
 * @extends Admin_Component_Abstract
 */
var Admin_Component_SongList_Abstract = Admin_Component_Abstract.extend({

	/** @type String */
	_class: 'Admin_Component_SongList_Abstract',

	events: {
		'clickConfirmed .deleteSong': function(event) {
			var id = $(event.currentTarget).closest('li.song').data('id');
			this.deleteSong(id);
			return false;
		}
	},

	/**
	 * @param {Number} id
	 */
	deleteSong: function(id) {
		this.ajax('deleteSong', {id: id});
	}
});
