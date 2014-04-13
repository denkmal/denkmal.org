<?php

class Denkmal_FormAction_EventAdd_Create extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('venue', 'date', 'fromTime', 'title');
    }

    protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $event = Denkmal_Form_EventAdd::getEventFromData($params);
        $now = new DateTime();

        if ($event->getFrom() < $now && !$event->getUntil()) {
            $response->addError($response->getRender()->getTranslation('Event in der Vergangenheit'), 'date');
        }
        if ($event->getUntil() < $now && $event->getUntil()) {
            $response->addError($response->getRender()->getTranslation('Event in der Vergangenheit'), 'date');
        }
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $venue = Denkmal_Form_EventAdd::getVenueFromData($params);

        $event = Denkmal_Form_EventAdd::getEventFromData($params);
        $event->setVenue($venue);
        $event->commit();
    }
}
