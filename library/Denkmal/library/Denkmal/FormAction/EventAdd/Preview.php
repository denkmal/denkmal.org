<?php

class Denkmal_FormAction_EventAdd_Preview extends CM_FormAction_Abstract {

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $region = $formParams->getRegion('region');

        /** @var Denkmal_Params $params */
        $venue = Denkmal_Form_EventAdd::getVenueFromData($params, $region);
        $event = Denkmal_Form_EventAdd::getEventFromData($params);
        $event->setVenueOverride($venue);

        return $response->loadComponent('Denkmal_Component_EventPreview', new Denkmal_Params(array(
            'event' => $event,
            'venue' => $venue,
        ), false));
    }
}
