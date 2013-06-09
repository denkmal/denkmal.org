<?php

class Admin_FormAction_VenueAlias_Add extends CM_FormAction_Abstract {

	public function __construct() {
		parent::__construct('add');
	}

	public function setup(CM_Form_Abstract $form) {
		$this->required_fields = array('name');

		parent::setup($form);
	}

	protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$name = $params->getString('name');
		if ($venue = Denkmal_Model_Venue::findByNameOrAlias($name)) {
			$response->addError('Name already used by venue `' . $venue->getName() . '`', 'name');
		}
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$venue = $params->getVenue('venueId');
		$name = $params->getString('name');

		Denkmal_Model_VenueAlias::create(array('venue' => $venue, 'name' => $name));

		$response->reloadComponent();
	}
}
