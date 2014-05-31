<?php

class Denkmal_FormAction_EventAdd_Create extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('venue', 'date', 'fromTime');
    }

    protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $event = Denkmal_Form_EventAdd::getEventFromData($params);
        $now = new DateTime();

        if ($event->getFrom() < $now && !$event->getUntil()) {
            $response->addError($response->getRender()->getTranslation('Event in der Vergangenheit'), 'date');
        }
        if ($event->getUntil() < $now && $event->getUntil()) {
            $response->addError($response->getRender()->getTranslation('Event in der Vergangenheit'), 'date');
        }

        if (!$params->has('title') && !$params->has('artists')) {
            $response->addError($response->getRender()->getTranslation('Bitte Titel oder KünstlerInnen angeben'), 'title');
        }
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        $venue = Denkmal_Form_EventAdd::getVenueFromData($params);
        $venue->commit();

        $event = Denkmal_Form_EventAdd::getEventFromData($params);
        $event->setVenue($venue);
        $event->commit();

        $fromDistance = ($event->getFrom()->getTimestamp() - time());
        if (($fromDistance / 3600) < 24) {
            $notificationEmail = new Admin_Mail_EventNotification($event);
            $notificationEmail->send();
        }
    }
}
