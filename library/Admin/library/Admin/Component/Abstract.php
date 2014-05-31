<?php

class Admin_Component_Abstract extends CM_Component_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

    public function checkAccessible(CM_Frontend_Environment $environment) {
        if (!$environment->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            throw new CM_Exception_AuthRequired();
        }
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
    }
}
