<?php

class Denkmal_Page_Add extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $viewResponse->set('region', $site->getRegion());
    }

    protected function _requiresRegion() {
        return true;
    }

}
