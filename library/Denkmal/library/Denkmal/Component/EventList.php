<?php

class Denkmal_Component_EventList extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->getParams()->getRegion('region');
        $date = $this->getParams()->getDateTime('date');
        $events = new Denkmal_Paging_Event_Date($region, $date);

        $viewResponse->set('date', $date);
        $viewResponse->set('events', $events);
    }
}
