<?php

class Admin_Component_LinkList_All extends Admin_Component_LinkList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

        if (null !== $searchTerm) {
            $linkList = new Denkmal_Paging_Link_Search($searchTerm);
        } else {
            $linkList = new Denkmal_Paging_Link_Working();
        }

        $this->_prepareList($linkList, $searchTerm, $viewResponse);
    }
}
