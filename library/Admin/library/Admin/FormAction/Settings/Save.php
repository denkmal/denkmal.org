<?php

class Admin_FormAction_Settings_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array();
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $response->reloadComponent();
    }
}
