<?php

class Admin_Component_EventList_Search extends Admin_Component_EventList_Abstract {

    public function prepare() {
        $text = $this->_params->getString('text');
        $eventList = new Denkmal_Paging_Event_SearchText($text);
        $this->_prepareList($eventList);
    }
}
