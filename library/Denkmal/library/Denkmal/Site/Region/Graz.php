<?php

class Denkmal_Site_Region_Graz extends Denkmal_Site_Region_Abstract {

    public function match(CM_Http_Request_Abstract $request, array $data) {
        $match = parent::match($request, $data);
        if ($match) {
            // @todo: enable site once ready
            $match = CM_Bootloader::getInstance()->isDebug();
        }
        return $match;
    }

    public function getRegion() {
        return Denkmal_Model_Region::findBySlug('graz');
    }

}
