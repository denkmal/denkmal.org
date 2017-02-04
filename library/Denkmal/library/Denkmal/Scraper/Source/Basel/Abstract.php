<?php

abstract class Denkmal_Scraper_Source_Basel_Abstract extends Denkmal_Scraper_Source_Abstract {

    public function getRegion() {
        return Denkmal_Model_Region::getBySlug('basel');
    }

}
