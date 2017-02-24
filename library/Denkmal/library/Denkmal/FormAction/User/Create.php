<?php

class Denkmal_FormAction_User_Create extends CM_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $paramsForm */
        $paramsForm = $form->getParams();

        $viewerIsAdmin = $response->getViewer() && $response->getViewer()->getRoles()->contains(Denkmal_Role::ADMIN);
        $userInvite = null;
        if ($paramsForm->has('inviteKey')) {
            $userInvite = Denkmal_Model_UserInvite::findByKey($paramsForm->getString('inviteKey'));
        }
        $email = $params->getString('email');
        $username = $params->getString('username');

        if (!$viewerIsAdmin && null === $userInvite) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }

        if (null !== Denkmal_Model_User::findByUsername($username)) {
            $response->addError($response->getRender()->getTranslation('Username already in use.'), 'username');
        }

        if (null !== Denkmal_Model_User::findByEmail($email)) {
            $response->addError($response->getRender()->getTranslation('Email already in use.'), 'email');
        }

        if (!$params->has('password')) {
            $response->addError('Password required', 'password');
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $paramsForm */
        $paramsForm = $form->getParams();
        /** @var Denkmal_Site_Default $site */
        $site = $response->getSite();

        $userInvite = null;
        if ($paramsForm->has('inviteKey')) {
            $userInvite = Denkmal_Model_UserInvite::findByKey($paramsForm->getString('inviteKey'));
        }
        $email = $params->getString('email');
        $username = $params->getString('username');
        $password = $params->getString('password');

        $user = Denkmal_Model_User::create($email, $username, $password);

        if (null !== $userInvite) {
            $userInvite->delete();
        }

        $response->getRequest()->getSession()->setUser($user);
        $response->redirect($site->getLoginPage());
    }
}
