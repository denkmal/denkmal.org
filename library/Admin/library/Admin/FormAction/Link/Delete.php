<?php

class Admin_FormAction_Link_Delete extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('linkId');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$link = $params->getLink('linkId');

		$link->delete();
	}
}
