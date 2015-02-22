<?php

class Admin_FormAction_Event_Show extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('eventId');
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $event = $params->getEvent('eventId');

        $event->setHidden(false);
        $event->setEnabled(true);

        $response->reloadComponent();
    }
}
