<?php

class Denkmal_Page_Suspended extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $autoPlay = $this->_params->getBoolean('autoPlay', true);
        $site = new Denkmal_Site();
        $suspension = $site->getSuspension();

        $songList = new Denkmal_Paging_Song_All();
        $song = $songList->getItemRand();

        $viewResponse->set('suspension', $suspension);
        $viewResponse->set('song', $song);
        $viewResponse->set('autoPlay', $autoPlay);
    }

    public function getLayout(CM_Frontend_Environment $environment, $layoutName = null) {
        return new Denkmal_Layout_Suspended();
    }
}
