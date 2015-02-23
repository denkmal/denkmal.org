<?php

class Denkmal_FormAction_Logout_Process extends Denkmal_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        $response->getRequest()->getSession()->deleteUser();
        $response->getRequest()->getSession()->setLifetime();

        $response->redirect('Denkmal_Page_Index', null, true);
    }
}
