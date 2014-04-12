<?php

class Admin_FormAction_Link_Add extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('label', 'url');
    }

    protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        parent::_checkData($params, $response, $form);
        $label = $params->getString('label');
        if (Denkmal_Model_Link::findByLabel($label)) {
            $response->addError($response->getRender()->getTranslation('Name wird bereits verwendet'), 'label');
        }
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $label = $params->getString('label');
        $url = $params->getString('url');
        $automatic = $params->getBoolean('automatic');
        Denkmal_Model_Link::create($label, $url, $automatic);
        Denkmal_Model_Link::deleteEventtextCaches();
    }
}
