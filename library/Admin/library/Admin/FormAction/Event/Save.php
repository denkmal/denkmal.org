<?php

class Admin_FormAction_Event_Save extends Admin_FormAction_Abstract {

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $event = $formParams->getEvent('event');

        $venue = $params->getVenue('venue');
        list($from, $until) = $this->_processDate($params);
        $description = $params->getString('description');
        $song = $params->has('song') ? $params->getSong('song') : null;
        $starred = $params->getBoolean('starred');

        $event->setVenue($venue);
        $event->setDescription($description);
        $event->setEnabled(true);
        $event->setQueued(false);
        $event->setFrom($from);
        $event->setUntil($until);
        $event->setSong($song);
        $event->setStarred($starred);

        $response->reloadComponent();
    }

    /**
     * @param Denkmal_Params $params
     * @return DateTime[]
     */
    protected function _processDate(Denkmal_Params $params) {
        $date = $params->getDateTime('date');

        $from = clone $date;
        $from->add($params->getDateInterval('fromTime'));

        $until = null;
        if ($params->has('untilTime')) {
            $until = clone $date;
            $until->add($params->getDateInterval('untilTime'));
            if ($until < $from) {
                $until->add(new DateInterval('P1D'));
            }
        }

        return array($from, $until);
    }
}
