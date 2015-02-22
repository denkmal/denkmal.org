<?php

class Denkmal_Scraper_Cli extends CM_Cli_Runnable_Abstract {

    public function run() {
        $scraperManager = new Denkmal_Scraper_Manager($this->_getStreamOutput());
        $scraperManager->process();
    }

    public static function getPackageName() {
        return 'scraper';
    }
}
