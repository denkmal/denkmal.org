<?php

class Admin_Form_Logout extends CM_Form_Abstract {

	public function setup() {
		$this->registerAction(new Admin_FormAction_Logout_Process($this));
	}
}
