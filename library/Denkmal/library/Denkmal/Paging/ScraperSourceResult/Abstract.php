<?php

class Denkmal_Paging_ScraperSourceResult_Abstract extends CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Scraper_SourceResult($itemRaw);
    }
}
