<?php

class Admin_Component_EventList_Queued extends Admin_Component_EventList_Abstract {

    public function prepare() {
        $eventList = new Admin_Paging_Event_Queued();
        $this->_prepareList($eventList);
    }
}
