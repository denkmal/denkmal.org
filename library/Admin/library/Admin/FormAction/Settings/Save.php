<?php

class Admin_FormAction_Settings_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array();
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $suspensionUntil = $params->has('suspensionUntil') ? $params->getDateTime('suspensionUntil') : null;

        $site = new Denkmal_Site();
        $site->getSuspension()->setUntil($suspensionUntil);
        $response->reloadComponent();
    }
}
