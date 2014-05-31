<?php

class Admin_Page_Log extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $type = $this->_params->getInt('type');
        $aggregate = $this->_params->has('aggregate') ? $this->_params->getInt('aggregate') : null;
        $page = $this->_params->getPage();

        $viewResponse->set('type', $type);
        $viewResponse->set('aggregate', $aggregate);
        $viewResponse->set('page', $page);
    }
}
