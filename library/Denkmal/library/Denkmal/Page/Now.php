<?php

class Denkmal_Page_Now extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site $site */
        $site = $environment->getSite();
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : null;

        $allowAdd = true;
        if ($site->getAnonymousMessagingDisabled() && !$environment->getViewer()) {
            $allowAdd = false;
        }

        $viewResponse->set('venue', $venue);
        $viewResponse->set('allowAdd', $allowAdd);
    }
}
