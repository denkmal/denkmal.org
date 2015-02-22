<?php

class Denkmal_App_Cli extends CM_App_Cli {

    public function status() {
        $status = array(
            'scraper-errors' => count($this->_getLastScraperErrors()),
        );

        $json = CM_Params::jsonEncode($status, true);
        $this->_getStreamOutput()->writeln($json);
    }

    /**
     * @return Denkmal_Scraper_SourceResult[]
     */
    private function _getLastScraperErrors() {
        $scraperManager = new Denkmal_Scraper_Manager();
        $lastScraperResults = Functional\map($scraperManager->getScraperList(), function (Denkmal_Scraper_Source_Abstract $scraper) {
            $resultList = new Denkmal_Paging_ScraperSourceResult_ScraperSource($scraper);
            return $resultList->getItem(0);
        });
        $lastScraperResults = array_filter($lastScraperResults);
        return Functional\select($lastScraperResults, function (Denkmal_Scraper_SourceResult $result) {
            return null !== $result->getError();
        });
    }
}
