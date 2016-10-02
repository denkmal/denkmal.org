<?php

class Admin_Page_Scraper_Facebook extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $region = $site->hasRegion() ? $site->getRegion() : null;
        $page = $this->_params->getPage();

        $facebookPageList = new Denkmal_Paging_FacebookPage_ListScraper($region);
        $facebookPageList->setPage($page, 50);

        $viewResponse->set('region', $region);
        $viewResponse->set('facebookPageList', $facebookPageList);
    }

    public function ajax_removeFacebookPage(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Site_Default $site */
        $site = $response->getSite();
        $region = $site->hasRegion() ? $site->getRegion() : null;
        $facebookPage = $params->getFacebookPage('facebookPage');

        $facebookPageList = new Denkmal_Paging_FacebookPage_ListScraper($region);
        $facebookPageList->remove($facebookPage);

        $response->reloadComponent();
    }

}
