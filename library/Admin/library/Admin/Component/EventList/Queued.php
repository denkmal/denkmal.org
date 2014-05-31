<?php

class Admin_Component_EventList_Queued extends Admin_Component_EventList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $eventList = new Admin_Paging_Event_Queued();
        $this->_prepareList($eventList, $viewResponse);
    }
}
