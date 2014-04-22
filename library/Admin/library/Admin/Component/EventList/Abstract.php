<?php

class Admin_Component_EventList_Abstract extends Admin_Component_Abstract {

    protected function _prepareList(CM_Paging_Abstract $eventList) {
        $eventList->setPage($this->_params->getPage(), $this->_params->getInt('count', 20));

        $this->setTplParam('eventList', $eventList);
    }
}
