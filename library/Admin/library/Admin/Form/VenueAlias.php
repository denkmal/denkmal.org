<?php

class Admin_Form_VenueAlias extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('venueId', new CM_FormField_Hidden());
		$this->registerField('name', new CM_FormField_Text());

		$this->registerAction(new Admin_FormAction_VenueAlias_Add($this));
	}

	protected function _renderStart(CM_Params $params) {
		/** @var Denkmal_Params $params */
		$venue = $params->getVenue('venue');
		$this->getField('venueId')->setValue($venue->getId());
	}
}
