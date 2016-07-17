<?php

class Admin_Page_Venues extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;
        if ('' === $searchTerm) {
            $searchTerm = null;
        }
        $region = $site->hasRegion() ? $site->getRegion() : null;

        $viewResponse->set('region', $region);
        $viewResponse->set('searchTerm', $searchTerm);
    }
}
