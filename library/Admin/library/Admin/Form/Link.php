<?php

class Admin_Form_Link extends CM_Form_Abstract {

	public function setup () {
		$this->registerField(new CM_FormField_Text('label'));
		$this->registerField(new CM_FormField_Url('url'));
		$this->registerField(new CM_FormField_Boolean('automatic'));

		$this->registerAction(new Admin_FormAction_Link_Add());
	}
}
