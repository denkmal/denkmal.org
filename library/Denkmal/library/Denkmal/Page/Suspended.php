<?php

class Denkmal_Page_Suspended extends Denkmal_Page_Abstract {

    public function prepare() {
        $autoPlay = $this->_params->getBoolean('autoPlay', true);
        $site = new Denkmal_Site();
        $suspension = $site->getSuspension();

        $songList = new Denkmal_Paging_Song_All();
        $song = $songList->getItemRand();

        $this->setTplParam('suspension', $suspension);
        $this->setTplParam('song', $song);
        $this->setTplParam('autoPlay', $autoPlay);
    }

    public function getLayout(CM_Site_Abstract $site, $layoutName = null) {
        return new Denkmal_Layout_Suspended($this);
    }
}
