<?php

class Denkmal_Form_SearchContent extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('term', new CM_FormField_Text());
		//		$this->registerAction(new Denkmal_FormAction_SearchContent_Search($this));
	}
}
