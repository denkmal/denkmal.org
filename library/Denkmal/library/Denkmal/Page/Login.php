<?php

class Denkmal_Page_Login extends Denkmal_Page_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

    public function checkAccessible(CM_Frontend_Environment $environment) {
        if (!$environment->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            throw new CM_Exception_AuthRequired();
        }
    }
}
