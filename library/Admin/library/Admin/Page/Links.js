/**
 * @class Admin_Page_Links
 * @extends Admin_Page_Abstract
 */
var Admin_Page_Links = Admin_Page_Abstract.extend({

	/** @type String */
	_class: 'Admin_Page_Links',

	childrenEvents: {
		'Admin_Form_Link success.Add': function(form) {
			form.reset();
			this.findChild('Admin_Component_LinkList_All').reload();
		}
	}
});
