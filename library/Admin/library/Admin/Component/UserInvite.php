<?php

class Admin_Component_UserInvite extends \Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $userInvite = $this->_params->getUserInvite('userInvite');
        $linkSite = new Denkmal_Site();

        $viewResponse->set('userInvite', $userInvite);
        $viewResponse->set('linkSite', $linkSite);
    }
}
