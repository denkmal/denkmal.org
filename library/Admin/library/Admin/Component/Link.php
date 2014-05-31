<?php

class Admin_Component_Link extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $link = $this->_params->getLink('link');

        $viewResponse->set('link', $link);
    }
}
