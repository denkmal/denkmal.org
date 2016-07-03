<?php

class Denkmal_Page_Login extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $emailAddress = $environment->getSite()->getEmailAddress();
        if ($site->hasRegion()) {
            $emailAddress = $site->getRegion()->getEmailAddress();
        }

        $viewResponse->set('emailAddress', $emailAddress);
    }
}
