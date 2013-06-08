<?php

class Admin_Form_Venue extends CM_Form_Abstract {

	public function __construct() {
		parent::__construct('venue');
	}

	public function setup() {
		$this->registerField(new CM_FormField_Text('name'));
		$this->registerField(new CM_FormField_Text('url'));
		$this->registerField(new CM_FormField_Text('address'));
		$this->registerField(new CM_FormField_Float('latitude'));
		$this->registerField(new CM_FormField_Float('longitude'));

		$this->registerAction(new Admin_FormAction_Venue_Add());
	}
}
