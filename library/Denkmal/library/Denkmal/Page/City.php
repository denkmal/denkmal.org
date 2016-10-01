<?php

class Denkmal_Page_City extends Denkmal_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        $siteList = $this->_getSiteList();
        if (0 === count($siteList)) {
            throw new CM_Exception('No regional sites found');
        }
        if (1 === count($siteList)) {
            $url = $response->getRender()->getUrlPage('Denkmal_Page_Index', [], reset($siteList));
            $response->redirectUrl($url);
        }
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $viewResponse->set('siteList', $this->_getSiteList());
    }

    /**
     * @return Denkmal_Site_Region_Abstract[]
     */
    private function _getSiteList() {
        return Denkmal_Site_Region_Abstract::getAllSites();
    }

}
