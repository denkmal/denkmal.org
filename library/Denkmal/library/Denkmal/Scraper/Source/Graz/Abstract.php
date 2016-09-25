<?php

abstract class Denkmal_Scraper_Source_Graz_Abstract extends Denkmal_Scraper_Source_Abstract {

    public function getRegion() {
        return Denkmal_Model_Region::getBySlug('graz');
    }

}
