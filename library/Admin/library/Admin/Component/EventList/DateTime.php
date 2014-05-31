<?php

class Admin_Component_EventList_DateTime extends Admin_Component_EventList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $date = $this->getParams()->getDateTime('date');
        $eventList = new Denkmal_Paging_Event_Date($date, true);
        $this->_prepareList($eventList);
    }
}
