<?php

class Denkmal_GoogleAnalytics_Client extends CMService_GoogleAnalytics_Client {

    public function trackPageView(CM_Frontend_Environment $environment, $path = null) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        if ($site->hasRegion()) {
            $this->setCustomDimension(1, $site->getRegion()->getSlug());
        }

        parent::trackPageView($environment, $path);
    }

}
