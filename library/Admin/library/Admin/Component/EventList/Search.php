<?php

class Admin_Component_EventList_Search extends Admin_Component_EventList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->getParams()->has('region') ? $this->getParams()->getRegion('region') : null;
        $text = $this->getParams()->getString('text');

        $eventList = new Denkmal_Paging_Event_SearchText($text, $region);
        $this->_prepareList($eventList, $viewResponse);
    }
}
