<?php

class Admin_FormAction_Link_Save extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('label', 'url');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$link = $params->getLink('linkId');
		$link->setLabel($params->getString('label'));
		$link->setUrl($params->getString('url'));
		$link->setAutomatic($params->getBoolean('automatic'));
		Denkmal_Model_Link::deleteEventtextCaches();

		$response->reloadComponent();
	}
}
