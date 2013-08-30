<?php

class Admin_FormAction_Link_Add extends CM_FormAction_Abstract {

	public function __construct() {
		parent::__construct('add');
	}

	public function setup(CM_Form_Abstract $form) {
		$this->required_fields = array('label', 'url');
		parent::setup($form);
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$label = $params->getString('label');
		$url = $params->getString('url');
		$automatic = $params->getBoolean('automatic');
		Denkmal_Model_Link::createStatic(array(
			'label' => $label,
			'url' => $url,
			'automatic' => $automatic,
		));
		$response->reloadPage();
	}
}
