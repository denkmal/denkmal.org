<?php

class Admin_Page_Events extends Admin_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        parent::prepareResponse($environment, $response);

        if (!$this->_params->has('date') && !$this->_params->has('searchTerm')) {
            $settings = new Denkmal_App_Settings();
            $now = $settings->getCurrentDate();
            $response->redirect('Admin_Page_Events', array('date' => $now->format('Y-n-j')));
        }
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $date = $this->_params->has('date') ? $this->_params->getDate('date') : null;
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;
        $region = $site->hasRegion() ? $site->getRegion() : null;

        $viewResponse->set('region', $region);
        $viewResponse->set('date', $date);
        $viewResponse->set('searchTerm', $searchTerm);
    }
}
