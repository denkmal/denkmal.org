<?php

class Denkmal_FormAction_Logout_Process extends CM_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Site_Abstract $site */
        $site = $response->getSite();

        $response->getRequest()->getSession()->logoutUser();

        $response->redirect($site->getLoginPage(), null, true);
    }
}
