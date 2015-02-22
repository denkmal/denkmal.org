<?php

abstract class Admin_FormAction_Abstract extends CM_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }
    }
}
