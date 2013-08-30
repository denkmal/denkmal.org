<?php

class Admin_Form_Venue extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('venueId', new CM_FormField_Hidden());
		$this->registerField('name', new CM_FormField_Text());
		$this->registerField('url', new CM_FormField_Url());
		$this->registerField('address', new CM_FormField_Text());
		$this->registerField('coordinates', new CM_FormField_GeoPoint());

		$this->registerAction(new Admin_FormAction_Venue_Add($this));
		$this->registerAction(new Admin_FormAction_Venue_Edit($this));
	}

	protected function _renderStart(CM_Params $params) {
		/** @var Denkmal_Params $params */
		if ($params->has('venue')) {
			$venue = $params->getVenue('venue');
			$this->getField('venueId')->setValue($venue->getId());
			$this->getField('name')->setValue($venue->getName());
			$this->getField('address')->setValue($venue->getAddress());
			$this->getField('coordinates')->setValue($venue->getCoordinates());
		}
	}
}
