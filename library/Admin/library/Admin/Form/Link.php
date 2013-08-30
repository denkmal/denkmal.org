<?php

class Admin_Form_Link extends CM_Form_Abstract {

	public function setup () {
		$this->registerField('label', new CM_FormField_Text());
		$this->registerField('url', new CM_FormField_Url());
		$this->registerField('automatic', new CM_FormField_Boolean());

		$this->registerAction(new Admin_FormAction_Link_Add($this));
	}
}
