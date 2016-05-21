<?php

class Admin_FormAction_Link_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('label', 'url');
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        parent::_checkData($params, $response, $form);
        $label = $params->getString('label');
        $linkSameName = Denkmal_Model_Link::findByLabel($label);
        /** @var Denkmal_Params $params */
        $linkId = $params->getInt('linkId');
        if ($linkSameName && $linkSameName->getId() != $linkId) {
            $response->addError($response->getRender()->getTranslation('Name already in use'), 'label');
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $link = $params->getLink('linkId');
        $link->setLabel($params->getString('label'));
        $link->setUrl($params->getString('url'));
        $link->setAutomatic($params->getBoolean('automatic'));
        $link->setFailedCount(0);
        Denkmal_Model_Link::deleteEventtextCaches();

        $response->reloadComponent();
    }
}
