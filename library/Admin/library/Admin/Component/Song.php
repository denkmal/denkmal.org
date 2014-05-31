<?php

class Admin_Component_Song extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $song = $this->_params->getSong('song');

        $viewResponse->set('song', $song);
    }
}
