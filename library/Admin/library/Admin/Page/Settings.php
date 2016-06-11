<?php

class Admin_Page_Settings extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->_hasRegion() ? $this->_getRegion() : null;

        $viewResponse->set('region', $region);
    }
}
