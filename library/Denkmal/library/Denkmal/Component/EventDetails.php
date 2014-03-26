<?php

class Denkmal_Component_EventDetails extends Denkmal_Component_Abstract {

    public function prepare() {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->getVenue('venue');

        $futureEvents = new Denkmal_Paging_Event_VenueDate($venue, $event->getFrom(), null, array($event));
        $futureEvents->setPage(1, 3);
        $pastEvents = new Denkmal_Paging_Event_VenueDate($venue, null, $event->getFrom(), array($event));
        $pastEvents->setPage(1, 1);

        $this->setTplParam('event', $event);
        $this->setTplParam('venue', $venue);
        $this->setTplParam('futureEvents', $futureEvents);
        $this->setTplParam('pastEvents', $pastEvents);

        $this->_params = CM_Params::factory(); // Empty params to not send them to client
    }
}
