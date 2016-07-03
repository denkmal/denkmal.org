<?php

class Denkmal_Page_Suspended extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();

        $suspension = $site->getRegion()->getSuspension();

        $songList = new Denkmal_Paging_Song_All();
        $song = $songList->getItemRand();

        $viewResponse->set('suspension', $suspension);
        $viewResponse->set('song', $song);
    }

    public function getLayout(CM_Frontend_Environment $environment, $layoutName = null) {
        return new Denkmal_Layout_Suspended();
    }

    protected function _requiresRegion() {
        return true;
    }
}
