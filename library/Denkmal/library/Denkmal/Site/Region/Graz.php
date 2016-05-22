<?php

class Denkmal_Site_Region_Graz extends Denkmal_Site_Region_Abstract {

    public function isEnabled() {
        return CM_Bootloader::getInstance()->isDebug();
    }

    protected function _getRegionSlug() {
        return 'graz';
    }

}
