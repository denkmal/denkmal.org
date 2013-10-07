<?php

class Admin_FormAction_Song_Delete extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('songId');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$song = $params->getSong('songId');

		$song->delete();
	}
}
