<?php

class Denkmal_FormAction_EventAdd_Preview extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('venue', 'date', 'fromTime');
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $event = Denkmal_Form_EventAdd::getEventFromData($params);
        $venue = Denkmal_Form_EventAdd::getVenueFromData($params);

        return $response->loadComponent(new Denkmal_Params(array(
            'className' => 'Denkmal_Component_EventPreview',
            'event'     => $event,
            'venue'     => $venue,
        )));
    }
}
