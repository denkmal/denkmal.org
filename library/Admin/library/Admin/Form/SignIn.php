<?php

class Admin_Form_SignIn extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('login', new CM_FormField_Text());
		$this->registerField('password', new CM_FormField_Text());

		$this->registerAction(new Admin_FormAction_SignIn_Process($this));
	}
}
