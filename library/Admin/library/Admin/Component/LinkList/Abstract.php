<?php

abstract class Admin_Component_LinkList_Abstract extends Admin_Component_Abstract {

    /**
     * @param CM_Paging_Abstract       $linkList
     * @param string|null              $searchTerm
     * @param CM_Frontend_ViewResponse $viewResponse
     */
    protected function _prepareList(CM_Paging_Abstract $linkList, $searchTerm = null, CM_Frontend_ViewResponse $viewResponse) {
        $linkList->setPage($this->_params->getPage(), $this->_params->getInt('count', 50));

        $viewResponse->set('linkList', $linkList);
        $viewResponse->set('searchTerm', $searchTerm);
    }
}
