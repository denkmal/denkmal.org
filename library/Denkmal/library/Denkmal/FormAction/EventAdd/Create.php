<?php

class Denkmal_FormAction_EventAdd_Create extends CM_FormAction_Abstract {

	public function __construct() {
		parent::__construct('create');
	}

	public function setup(CM_Form_Abstract $form) {
		$this->required_fields = array('venue', 'date', 'fromTime', 'title');
		parent::setup($form);
	}

	public function process(array $data, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$data = Denkmal_Params::factory($data);
		$venue = $data->get('venue');
		if (!$venue instanceof Denkmal_Model_Venue) {
			$address = $data->has('venueAddress') ? $data->getString('venueAddress') : null;
			$url = $data->has('venueUrl') ? $data->getString('venueUrl') : null;
			$venueData = array(
				'name' => (string) $venue,
				'queued' => true,
				'enabled' => false,
				'address' => $address,
				'url' => $url,
			);
			$venue = Denkmal_Model_Venue::create($venueData);
		}
	}
}
