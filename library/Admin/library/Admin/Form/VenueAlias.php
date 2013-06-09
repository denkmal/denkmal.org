<?php

class Admin_Form_VenueAlias extends CM_Form_Abstract {

	public function __construct() {
		parent::__construct('venueAlias');
	}

	public function setup() {
		$this->registerField(new CM_FormField_Hidden('venueId'));
		$this->registerField(new CM_FormField_Text('name'));

		$this->registerAction(new Admin_FormAction_VenueAlias_Add());
	}

	protected function _renderStart(CM_Params $params) {
		/** @var Denkmal_Params $params */
		$venue = $params->getVenue('venue');
		$this->getField('venueId')->setValue($venue->getId());
	}
}
