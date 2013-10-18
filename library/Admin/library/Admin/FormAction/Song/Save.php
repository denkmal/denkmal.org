<?php

class Admin_FormAction_Song_Save extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('label');
	}

	protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		parent::_checkData($params, $response, $form);
		$label = $params->getString('label');
		if (Denkmal_Model_Song::findByLabel($label)) {
			$response->addError($response->getRender()->getTranslation('label is already used'), 'label');
		}
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$song = $params->getSong('songId');
		$song->setLabel($params->getString('label'));

		$response->reloadComponent();
	}
}
