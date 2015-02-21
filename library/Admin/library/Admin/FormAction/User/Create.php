<?php

class Admin_FormAction_User_Create extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('email', 'username', 'password');
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $email = $params->getString('email');
        $username = $params->getString('username');
        $password = $params->getString('password');

        Denkmal_Model_User::create($email, $username, $password);
    }
}
