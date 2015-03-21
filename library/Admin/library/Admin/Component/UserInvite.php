<?php

class Admin_Component_UserInvite extends \Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $userInvite = $this->_params->getUserInvite('userInvite');

        $viewResponse->set('userInvite', $userInvite);
    }
}
