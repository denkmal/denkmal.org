<?php

class Admin_Component_Abstract extends CM_Component_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

    public function checkAccessible(CM_Render $render) {
        if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            throw new CM_Exception_AuthRequired();
        }
    }
}
