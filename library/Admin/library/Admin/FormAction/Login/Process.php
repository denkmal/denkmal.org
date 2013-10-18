<?php

class Admin_FormAction_Login_Process extends Admin_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('email', 'password');
	}

	protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		try {
			$user = Denkmal_Model_User::authenticate($params->getString('email'), $params->getString('password'));
		} catch (CM_Exception_AuthFailed $e) {
			$response->addError($e->getMessagePublic($response->getRender()), 'password');
			return;
		}

		$response->getRequest()->getSession()->setUser($user);
		$response->addMessage($response->getRender()->getTranslation('Erfolgreich angemeldet. Bitte warten...'));
		$response->redirect('Admin_Page_Index', null, true);
	}
}
