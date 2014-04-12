<?php

class Admin_Component_EventList_Queued extends Admin_Component_EventList_Abstract {

    public function prepare() {
        $eventList = new Admin_Paging_Event_Queued();
        $eventList->setPage($this->_params->getPage(), $this->_params->getInt('count', 10));

        $this->_prepareList($eventList);
    }
}
