<?php

class Admin_FormAction_Event_Preview extends Admin_FormAction_Event_Save {

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $event = $formParams->getEvent('event');

        $venue = $params->getVenue('venue');
        list($from, $until) = $this->_processDate($params);
        $description = $params->getString('description');
        $genres = $params->has('genres') ? $params->getString('genres') : null;
        $song = $params->has('song') ? $params->getSong('song') : null;
        $starred = $params->getBoolean('starred');

        $event->setAutoCommit(false);

        $event->setVenue($venue);
        $event->setDescription($description);
        $event->setGenres($genres);
        $event->setFrom($from);
        $event->setUntil($until);
        $event->setSong($song);
        $event->setStarred($starred);

        return $response->loadComponent('Denkmal_Component_EventPreview', new Denkmal_Params(array(
            'event' => $event,
            'venue' => $venue,
        ), false));
    }
}
