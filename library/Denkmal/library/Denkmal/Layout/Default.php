<?php

class Denkmal_Layout_Default extends CM_Layout_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $chatActivityStamp = (new Denkmal_Paging_Message_All())->getLastActivityStamp();

        $site = $environment->getSite();
        $region = null;
        if ($site instanceof Denkmal_Site_Default && $site->hasRegion()) {
            $region = $site->getRegion();
        }

        $viewResponse->getJs()->setProperty('chatActivityStamp', $chatActivityStamp);
        $viewResponse->set('region', $region);
    }
}
