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
        $siteClassList = Denkmal_Site_Region_Abstract::getClassChildren();
        $siteList = Functional\map($siteClassList, function($className) {
            return new $className();
        });
        $siteList = Functional\filter($siteList, function(Denkmal_Site_Region_Abstract $site) {
            return $site->isEnabled();
        });

        $viewResponse->set('siteList', $siteList);
    }

}
