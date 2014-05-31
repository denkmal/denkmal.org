<?php

class Denkmal_Component_EventDetails extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->getVenue('venue');

        $now = Denkmal_Site::getCurrentDate();
        $futureEvents = new Denkmal_Paging_Event_VenueDateInterval($venue, $now, null, array($event));
        $futureEvents->setPage(1, 4);

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);
        $viewResponse->set('futureEvents', $futureEvents);

        $this->_params = CM_Params::factory(); // Empty params to not send them to client
    }
}
