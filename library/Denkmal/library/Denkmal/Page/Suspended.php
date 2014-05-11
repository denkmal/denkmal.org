<?php

class Denkmal_Page_Suspended extends Denkmal_Page_Abstract {

    public function prepare() {
        $site = new Denkmal_Site();
        $suspension = $site->getSuspension();

        $songList = new Denkmal_Paging_Song_All();
        $song = $songList->getItemRand();

        $this->setTplParam('suspension', $suspension);
        $this->setTplParam('song', $song);
    }

    public function getLayout(CM_Site_Abstract $site, $layoutName = null) {
        return new Denkmal_Layout_Suspended($this);
    }
}
