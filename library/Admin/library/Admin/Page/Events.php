<?php

class Admin_Page_Events extends Admin_Page_Abstract {

    public function prepareResponse(CM_Response_Page $response) {
        if (!$this->_params->has('date') && !$this->_params->has('searchTerm')) {
            $now = Denkmal_Site::getCurrentDate();
            $response->redirect('Admin_Page_Events', array('date' => $now->format('Y-n-j')));
        }
    }

    public function prepare() {
        $date = $this->_params->has('date') ? $this->_params->getDate('date') : null;
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

        $this->setTplParam('date', $date);
        $this->setTplParam('searchTerm', $searchTerm);
    }
}
