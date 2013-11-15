/**
 * @class Denkmal_Component_EventAdd
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_EventAdd = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_EventAdd',

	events:{
		'click .addSimilar': 'addSimilar'
	},

	childrenEvents: {
		'Denkmal_Form_EventAdd success': function() {
			this.$('.Denkmal_Form_EventAdd .preview').hide();
			this.$('.Denkmal_Form_EventAdd .formWrapper').slideUp();
			this.$('.thankYou').slideDown();
		}
	},

	addSimilar: function(){
		this.$('.Denkmal_Form_EventAdd .preview').show();
		this.$('.Denkmal_Form_EventAdd .formWrapper').slideDown();
		this.$('.thankYou').slideUp();
	}
});
