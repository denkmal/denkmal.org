<?php

class Admin_FormAction_EventLink_Add extends Admin_FormAction_Abstract {

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $event = $formParams->getEvent('event');

        $label = $params->getString('label');
        $url = $params->getString('url');
        Denkmal_Model_EventLink::create($event, $label, $url);

        $response->reloadComponent();
    }
}
