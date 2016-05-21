<?php

class Denkmal_FormAction_ChangePassword_Process extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('old_password', 'new_password', 'new_password_confirm');
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Model_User $user */
        $user = $response->getViewer(true);

        if (!Denkmal_App_Auth::checkLogin($user->getEmail(), $params->getString('old_password'))) {
            $response->addError($response->getRender()->getTranslation('Wrong password.'), 'old_password');
        } else {
            if ($params->getString('new_password') != $params->getString('new_password_confirm')) {
                $response->addError($response->getRender()->getTranslation('Passwords don\'t match.'), 'new_password_confirm');
            }
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Model_User $user */
        $user = $response->getViewer(true);
        $user->setPassword($params->getString('new_password'));
        $response->addMessage($response->getRender()->getTranslation('Password has been changed.'));
    }
}
