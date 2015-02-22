<?php

class Admin_Component_LogList extends CM_Component_LogList {

    public function checkAccessible(CM_Frontend_Environment $environment) {
        if (!$environment->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            throw new CM_Exception_AuthRequired();
        }
    }

    protected function _getAllowedFlush(CM_Frontend_Environment $environment) {
        $viewer = $environment->getViewer();
        return $viewer && $viewer->getRoles()->contains(Denkmal_Role::ADMIN);
    }
}
