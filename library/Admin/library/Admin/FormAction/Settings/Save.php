<?php

class Admin_FormAction_Settings_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array();
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        $suspensionUntil = $params->has('suspensionUntil') ? $params->getDateTime('suspensionUntil') : null;
        $anonymousMessagingDisabled = $params->getBoolean('anonymousMessagingDisabled');

        $settings = new Denkmal_App_Settings();
        $settings->getSuspension()->setUntil($suspensionUntil);
        $settings->setAnonymousMessagingDisabled($anonymousMessagingDisabled);

        $response->reloadComponent();
    }
}
