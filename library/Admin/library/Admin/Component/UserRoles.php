<?php

class Admin_Component_UserRoles extends \Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $user = $this->_params->getUser('user');

        $viewResponse->set('user', $user);
    }

    public function checkAccessible(CM_Frontend_Environment $environment) {
        if (!$environment->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            throw new CM_Exception_AuthRequired();
        }
    }

    public function ajax_setRole(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $user = $this->_params->getUser('user');
        $role = $params->getInt('role');
        $state = $params->getBoolean('state');

        if ($state) {
            $user->getRoles()->add($role);
        } else {
            $user->getRoles()->delete($role);
        }
    }
}
