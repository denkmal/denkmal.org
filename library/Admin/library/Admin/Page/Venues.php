<?php

class Admin_Page_Venues extends Admin_Page_Abstract {

    public function prepare() {
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;
        if (!$searchTerm) {
            $searchTerm = null;
        }

        $this->setTplParam('searchTerm', $searchTerm);
    }
}
