<?php

class Admin_Component_EventList_Search extends Admin_Component_EventList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $text = $this->_params->getString('text');
        $eventList = new Denkmal_Paging_Event_SearchText($text);
        $this->_prepareList($eventList, $viewResponse);
    }
}
