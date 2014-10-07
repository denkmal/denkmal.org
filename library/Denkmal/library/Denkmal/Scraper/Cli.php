<?php

class Denkmal_Scraper_Cli extends CM_Cli_Runnable_Abstract {

    public function run() {
        /** @var Denkmal_Scraper_Source_Abstract $scraper */
        foreach (new Denkmal_Paging_ScraperSource_All() as $scraper) {
            $this->_getStreamOutput()->writeln('Running scraper `' . get_class($scraper) . '`…');
            $scraper->run();
        }
    }

    public static function getPackageName() {
        return 'scraper';
    }
}
