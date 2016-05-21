<?php

class Denkmal_Site_Region_Basel extends Denkmal_Site_Region_Abstract {

    public function getRegion() {
        return Denkmal_Model_Region::findBySlug('basel');
    }

}
