<?php

class Denkmal_Page_Regions extends Denkmal_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        if (!$environment->isDebug()) {
            // @todo: Remove once regions selection page is ready
            $url = $response->getRender()->getUrlPage('Denkmal_Page_Index', [], new Denkmal_Site_Region_Basel());
            $response->redirectUrl($url);
        }
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $viewResponse->set('siteList', Denkmal_Site_Region_Abstract::getAllSites());
    }

}
