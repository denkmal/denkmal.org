<?php

class Admin_Form_Venue extends CM_Form_Abstract {

	public function __construct() {
		parent::__construct('venue');
	}

	public function setup() {
		$this->registerField(new CM_FormField_Hidden('venueId'));
		$this->registerField(new CM_FormField_Text('name'));
		$this->registerField(new CM_FormField_Url('url'));
		$this->registerField(new CM_FormField_Text('address'));
		$this->registerField(new CM_FormField_GeoPoint('coordinates'));

		$this->registerAction(new Admin_FormAction_Venue_Add());
		$this->registerAction(new Admin_FormAction_Venue_Edit());
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
