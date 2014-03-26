<?php

class Admin_Component_EventList_DateTime extends Admin_Component_EventList_Abstract {

    public function prepare() {
        $date = $this->getParams()->getDateTime('date');
        $eventList = new Denkmal_Paging_Event_Date($date, true);

        $this->_prepareList($eventList);
    }
}
