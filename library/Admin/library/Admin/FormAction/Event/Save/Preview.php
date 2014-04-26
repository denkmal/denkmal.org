<?php

class Admin_FormAction_Event_Save_Preview extends Admin_FormAction_Event_Save {

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $event = $params->getEvent('eventId');
        $venue = $params->getVenue('venue');
        list($from, $until) = $this->_processDate($params);
        $description = $params->getString('description');
        $song = $params->has('song') ? $params->getSong('song') : null;
        $starred = $params->getBoolean('starred');

        $event->setAutoCommit(false);

        $event->setVenue($venue);
        $event->setDescription($description);
        $event->setFrom($from);
        $event->setUntil($until);
        $event->setSong($song);
        $event->setStarred($starred);

        return $response->loadComponent(new Denkmal_Params(array(
            'className'    => 'Admin_Component_Event',
            'event'        => $event,
            'venue'        => $venue,
            'allowEditing' => false,
        )));
    }
}
