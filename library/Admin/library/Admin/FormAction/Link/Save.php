<?php

class Admin_FormAction_Link_Save extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('label', 'url');
	}

	protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		parent::_checkData($params, $response, $form);
		$label = $params->getString('label');
		if (Denkmal_Model_Link::findByLabel($label)) {
			$response->addError($response->getRender()->getTranslation('label is already used'), 'label');
		}
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$link = $params->getLink('linkId');
		$link->setLabel($params->getString('label'));
		$link->setUrl($params->getString('url'));
		$link->setAutomatic($params->getBoolean('automatic'));

		$response->reloadComponent();
	}
}
