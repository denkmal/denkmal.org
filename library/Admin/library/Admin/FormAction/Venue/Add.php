<?php

class Admin_FormAction_Venue_Add extends CM_FormAction_Abstract {

	public function __construct() {
		parent::__construct('add');
	}

	public function setup(CM_Form_Abstract $form) {
		$this->required_fields = array('name');

		parent::setup($form);
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$name = $params->getString('name');
		$url = $params->has('url') ? $params->getString('url') : null;
		$address = $params->has('address') ? $params->getString('address') : null;
		$coordinates = $params->has('coordinates') ? $params->getGeoPoint('coordinates') : null;

		$venue = Denkmal_Model_Venue::create(array(
			'name'        => $name,
			'url'         => $url,
			'address'     => $address,
			'coordinates' => $coordinates,
			'queued'      => false,
			'enabled'     => true,
		));

		$response->redirect('Admin_Page_Venue', array('venue' => $venue->getId()));
	}
}
