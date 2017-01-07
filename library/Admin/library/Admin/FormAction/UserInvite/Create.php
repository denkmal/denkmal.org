<?php

class Admin_FormAction_UserInvite_Create extends Admin_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        parent::_checkData($params, $response, $form);
        $email = $params->has('email') ? $params->getString('email') : null;
        $sendEmail = $params->getBoolean('sendEmail');

        if (null === $email && true === $sendEmail) {
            $response->addError($response->getRender()->getTranslation('Can\'t send invitation. Email is missing.'), 'sendEmail');
        }
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
