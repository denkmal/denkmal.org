<?php

class Admin_Component_UserRoles extends \Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $user = $this->_params->getUser('user');

        $viewResponse->set('user', $user);
    }
}
