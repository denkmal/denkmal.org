<?php

class Admin_Component_EventList_Abstract extends Admin_Component_Abstract {

    /**
     * @param CM_Paging_Abstract       $eventList
     * @param CM_Frontend_ViewResponse $viewResponse
     */
    protected function _prepareList(CM_Paging_Abstract $eventList, CM_Frontend_ViewResponse $viewResponse) {
        $eventList->setPage($this->_params->getPage(), $this->_params->getInt('count', 20));

        $viewResponse->set('eventList', $eventList);
    }
}
