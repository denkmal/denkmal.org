<?php

class Denkmal_Page_Index extends Denkmal_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        parent::prepareResponse($environment, $response);
        if ($response->getRedirectUrl()) {
            return;
        }

        /** @var Denkmal_Site_Default $site */
        $site = $response->getSite();
        if ($site->hasRegion()) {
            $response->redirect('Denkmal_Page_Events');
        } else {
            $site = $this->_findSiteByRequest($response->getRequest());
            if ($site) {
                $response->redirectUrl($response->getRender()->getUrlPage('Denkmal_Page_Events', null, $site));
            } else {
                $response->redirect('Denkmal_Page_Regions');
            }
        }
    }

    /**
     * @param CM_Http_Request_Abstract $request
     * @return Denkmal_Site_Region_Abstract|null
     * @throws CM_Exception
     */
    private function _findSiteByRequest(CM_Http_Request_Abstract $request) {
        $location = $request->getLocation();
        if (!$location) {
            return null;
        }
        $geoPoint = $location->getGeoPoint();
        if (!$geoPoint) {
            return null;
        }
        return Denkmal_Site_Region_Abstract::findSiteByGeoPoint($geoPoint);
    }

}
