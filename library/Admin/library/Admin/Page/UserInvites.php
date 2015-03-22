<?php

class Admin_Page_UserInvites extends \Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $userInviteList = new Denkmal_Paging_UserInvite_All();
        $userInviteList->setPage($this->_params->getPage(), $this->_params->getInt('count', 20));

        $viewResponse->set('userInviteList', $userInviteList);
    }
}
