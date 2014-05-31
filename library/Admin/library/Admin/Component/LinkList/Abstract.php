<?php

abstract class Admin_Component_LinkList_Abstract extends Admin_Component_Abstract {

    protected function _prepareList(CM_Paging_Abstract $linkList, $searchTerm = null) {
        $linkList->setPage($this->_params->getPage(), $this->_params->getInt('count', 50));

        $viewResponse->set('linkList', $linkList);
        $viewResponse->set('searchTerm', $searchTerm);
    }
}
