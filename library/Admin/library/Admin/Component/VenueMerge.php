<?php

class Admin_Component_VenueMerge extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venue = $this->_params->getVenue('venue');

        $viewResponse->set('venue', $venue);
    }
}
