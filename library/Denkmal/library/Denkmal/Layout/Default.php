<?php

class Denkmal_Layout_Default extends CM_Layout_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $site = $environment->getSite();
        $region = null;

        if ($site instanceof Denkmal_Site_Default && $site->hasRegion()) {
            $region = $site->getRegion();
            $messageList = $site->getRegion()->getMessageList();
            $viewResponse->getJs()->setProperty('chatActivityStamp', $messageList->getLastActivityStamp());
        }

        $viewResponse->set('region', $region);
        $viewResponse->getJs()->setProperty('region', $region);
    }
}
