<?php

class Admin_Component_SelectRegion extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $region = $site->hasRegion() ? $site->getRegion() : null;

        $optionList = [];
        /** @var Denkmal_Model_Region $region */
        foreach (new Denkmal_Paging_Region_All() as $item) {
            $optionList[$item->getId()] = $item->getName();
        }

        $viewResponse->set('option', $region ? $region->getId() : null);
        $viewResponse->set('optionList', $optionList);
    }

    public function ajax_setRegion(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        $region = $params->has('region') ? $params->getRegion('region') : null;

        $session = $response->getRequest()->getSession();
        if ($region) {
            $session->set('region', $region->getId());
        } else {
            $session->delete('region');
        }

        $response->reloadPage();
    }

}
