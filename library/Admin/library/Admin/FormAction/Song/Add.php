<?php

class Admin_FormAction_Song_Add extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('label', 'file');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
	}
}
