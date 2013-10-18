<?php

class Admin_Form_Login extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('login', new CM_FormField_Text());
		$this->registerField('password', new CM_FormField_Password());

		$this->registerAction(new Admin_FormAction_Login_Process($this));
	}
}
