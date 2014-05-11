<?php

class Admin_Page_Log extends Admin_Page_Abstract {

    public function prepare() {
        $type = $this->_params->getInt('type');
        $aggregate = $this->_params->has('aggregate') ? $this->_params->getInt('aggregate') : null;
        $page = $this->_params->getPage();

        $this->setTplParam('type', $type);
        $this->setTplParam('aggregate', $aggregate);
        $this->setTplParam('page', $page);
    }
}
