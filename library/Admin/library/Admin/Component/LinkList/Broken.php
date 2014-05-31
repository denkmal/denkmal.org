<?php

class Admin_Component_LinkList_Broken extends Admin_Component_LinkList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $linkList = new Denkmal_Paging_Link_Broken();

        $this->_prepareList($linkList);
    }
}
