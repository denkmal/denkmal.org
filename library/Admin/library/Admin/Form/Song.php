<?php

class Admin_Form_Song extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('label', new CM_FormField_Text());
		$this->registerField('files', new Denkmal_FormField_FileSong());

		$this->registerAction(new Admin_FormAction_Song_Add($this));
	}
}
