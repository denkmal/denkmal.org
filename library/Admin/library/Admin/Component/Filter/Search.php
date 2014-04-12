<?php

class Admin_Component_Filter_Search extends Admin_Component_Abstract {

    public function prepare() {
        $urlPage = $this->_params->getString('urlPage');
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

        $this->setTplParam('urlPage', $urlPage);
        $this->setTplParam('searchTerm', $searchTerm);
    }
}
