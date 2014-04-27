<?php

class Denkmal_Paging_ScraperSource_All extends CM_Paging_Abstract {

    public function __construct() {
        $scraperList = array(
            new Denkmal_Scraper_Source_Programmzeitung(),
            new Denkmal_Scraper_Source_Fingerzeig(),
            new Denkmal_Scraper_Source_Hinterhof(),
        );

        $source = new CM_PagingSource_Array($scraperList);
        parent::__construct($source);
    }
}
