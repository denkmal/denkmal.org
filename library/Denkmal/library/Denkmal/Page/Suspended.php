<?php

class Denkmal_Page_Suspended extends Denkmal_Page_Abstract {

    public function prepare() {
        $site = new Denkmal_Site();
        $suspension = $site->getSuspension();

        $this->setTplParam('suspension', $suspension);
    }
}
