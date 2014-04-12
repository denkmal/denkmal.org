<?php

class Denkmal_Scraper_Cli extends CM_Cli_Runnable_Abstract {

    public function run() {
        foreach (Denkmal_Scraper_Source_Abstract::getAll() as $scraper) {
            $this->_getOutput()->writeln('Running scraper `' . get_class($scraper) . '`…');
            $scraper->run();
        }
    }

    public static function getPackageName() {
        return 'scraper';
    }
}
