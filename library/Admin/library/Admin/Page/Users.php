<?php

class Admin_Page_Users extends \Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $userList = new Denkmal_Paging_User_All();
        $userList->setPage($this->_params->getPage(), $this->_params->getInt('count', 20));

        $viewResponse->set('userList', $userList);
    }
}
