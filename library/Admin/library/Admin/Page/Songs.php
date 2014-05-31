<?php

class Admin_Page_Songs extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;
        if (!$searchTerm) {
            $searchTerm = null;
        }

        $viewResponse->set('searchTerm', $searchTerm);
    }
}
