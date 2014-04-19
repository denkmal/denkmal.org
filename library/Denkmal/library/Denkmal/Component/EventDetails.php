<?php

class Denkmal_Component_EventDetails extends Denkmal_Component_Abstract {

    public function prepare() {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->getVenue('venue');

        $now = Denkmal_Site::getCurrentDate();
        $futureEvents = new Denkmal_Paging_Event_VenueDateInterval($venue, $now, null, array($event));
        $futureEvents->setPage(1, 4);

        $this->setTplParam('event', $event);
        $this->setTplParam('venue', $venue);
        $this->setTplParam('futureEvents', $futureEvents);

        $this->_params = CM_Params::factory(); // Empty params to not send them to client
    }
}
