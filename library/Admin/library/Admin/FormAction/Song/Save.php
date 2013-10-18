<?php

class Admin_FormAction_Song_Save extends Admin_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('label');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$song = $params->getSong('songId');
		$song->setLabel($params->getString('label'));

		$response->reloadComponent();
	}
}
