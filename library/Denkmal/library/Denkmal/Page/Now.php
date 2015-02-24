<?php

class Denkmal_Page_Now extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site $site */
        $site = $environment->getSite();

        $allowAdd = true;
        if ($site->getAnonymousMessagingDisabled() && !$environment->getViewer()) {
            $allowAdd = false;
        }

        $viewResponse->set('allowAdd', $allowAdd);
    }
}
