<?php

class Admin_Page_Log extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $level = $this->_params->has('level') ? $this->_params->getInt('level') : null;
        $aggregate = $this->_params->has('aggregate') ? $this->_params->getInt('aggregate') : null;
        $page = $this->_params->getPage();

        $viewResponse->set('level', $level);
        $viewResponse->set('aggregate', $aggregate);
        $viewResponse->set('page', $page);
    }
}
