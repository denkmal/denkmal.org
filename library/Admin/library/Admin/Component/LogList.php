<?php

class Admin_Component_LogList extends CM_Component_LogList {

    public function checkAccessible(CM_Render $render) {
        if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            throw new CM_Exception_AuthRequired();
        }
    }

    protected static function _getAllowedFlush(CM_Render $render) {
        $viewer = $render->getViewer();
        return $viewer && $viewer->getRoles()->contains(Denkmal_Role::ADMIN);
    }
}
