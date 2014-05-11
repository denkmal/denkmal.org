<?php

class Denkmal_Page_Suspended extends Denkmal_Page_Abstract {

    public function prepare() {
        $site = new Denkmal_Site();
        $suspension = $site->getSuspension();

        $this->setTplParam('suspension', $suspension);
    }

    public function getLayout(CM_Site_Abstract $site, $layoutName = null) {
        return new Denkmal_Layout_Suspended($this);
    }
}
