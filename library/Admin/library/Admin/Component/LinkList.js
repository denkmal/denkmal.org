/**
 * @class Admin_Component_LinkList
 * @extends Admin_Component_Abstract
 */
var Admin_Component_LinkList = Admin_Component_Abstract.extend({

	/** @type String */
	_class: 'Admin_Component_LinkList',

	childrenEvents: {
		'Admin_Form_Link success.Delete': function() {
			this.reload();
		}
	}
});
