<?php

class Denkmal_Page_Add extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $viewResponse->set('region', $this->_getRegion());
    }

    protected function _requiresRegion() {
        return true;
    }

}
