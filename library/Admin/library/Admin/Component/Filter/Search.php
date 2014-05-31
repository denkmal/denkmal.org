<?php

class Admin_Component_Filter_Search extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $urlPage = $this->_params->getString('urlPage');
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

        $viewResponse->set('urlPage', $urlPage);
        $viewResponse->set('searchTerm', $searchTerm);
    }
}
