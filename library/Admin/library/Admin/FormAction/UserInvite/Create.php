<?php

class Admin_FormAction_UserInvite_Create extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return [];
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $inviter = $response->getViewer(true);
        $email = $params->has('email') ? $params->getString('email') : null;
        $expires = $params->getDate('expires');
        $sendEmail = $params->getBoolean('sendEmail');

        $userInvite = Denkmal_Model_UserInvite::create($inviter, $email, $expires);

        if ($sendEmail) {
            $email = new Denkmal_Mail_UserInvite($userInvite);
            $email->send();
        }
    }
}
