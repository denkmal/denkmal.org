<?php

class Admin_FormAction_UserInvite_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return [];
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $paramsForm */
        $paramsForm = $form->getParams();

        $userInvite = $paramsForm->getUserInvite('userInvite');

        /** @var Denkmal_Params $params */
        $email = $params->has('email') ? $params->getString('email') : null;
        $expires = $params->getDate('expires');

        $userInvite->setEmail($email);
        $userInvite->setExpires($expires);

        $response->reloadComponent();
    }
}
