<?php

class Denkmal_FormAction_Login_Process extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('login', 'password');
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Site $site */
        $site = $response->getSite();

        try {
            $user = Denkmal_Model_User::authenticate($params->getString('login'), $params->getString('password'));
        } catch (CM_Exception_AuthFailed $e) {
            $response->addError($e->getMessagePublic($response->getRender()), 'password');
            return;
        }

        $response->getRequest()->getSession()->setUser($user);
        $response->getRequest()->getSession()->setLifetime(86400 * 14);

        $response->addMessage($response->getRender()->getTranslation('Login successful. Please wait…'));
        $response->redirect($site->getLoginPage(), null, true);
    }
}
