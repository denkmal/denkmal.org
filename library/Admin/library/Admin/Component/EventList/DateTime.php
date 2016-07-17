<?php

class Admin_Component_EventList_DateTime extends Admin_Component_EventList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->getParams()->getRegion('region');
        $date = $this->getParams()->getDateTime('date');

        $eventList = new Denkmal_Paging_Event_Date($region, $date, true);
        $this->_prepareList($eventList, $viewResponse);
    }
}
