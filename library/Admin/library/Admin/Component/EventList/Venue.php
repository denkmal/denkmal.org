<?php

class Admin_Component_EventList_Venue extends Admin_Component_EventList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venue = $this->_params->getVenue('venue');
        $eventList = new Denkmal_Paging_Event_VenueFuture($venue, true);
        $this->_prepareList($eventList, $viewResponse);
    }
}
