<?php

class Admin_FormAction_User_Create extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('email', 'username', 'password');
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $email = $params->getString('email');
        $username = $params->getString('username');
        $password = $params->getString('password');

        Denkmal_Model_User::create($email, $username, $password);
    }
}
