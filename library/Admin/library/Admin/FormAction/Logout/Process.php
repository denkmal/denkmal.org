<?php

class Admin_FormAction_Logout_Process extends Admin_FormAction_Abstract {

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $response->getRequest()->getSession()->deleteUser();
        $response->getRequest()->getSession()->setLifetime();

        $response->redirect('Admin_Page_Index', null, true);
    }
}
