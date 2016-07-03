<?php

class Admin_Page_Settings extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $region = $site->hasRegion() ? $site->getRegion() : null;

        $viewResponse->set('region', $region);
    }
}
