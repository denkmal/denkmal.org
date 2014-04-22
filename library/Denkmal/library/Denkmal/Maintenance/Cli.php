<?php

class Denkmal_Maintenance_Cli extends CM_Maintenance_Cli {

    /**
     * @synchronized
     */
    protected function _registerCallbacks() {
        parent::_registerCallbacks();
        $this->_registerClockworkCallbacks(new DateInterval('PT12H'), array(
            'Scraper'     => function () {
                    /** @var Denkmal_Scraper_Source_Abstract $scraper */
                    foreach (new Denkmal_Paging_ScraperSource_All() as $scraper) {
                        $scraper->run();
                    }
                },
            'Check links' => function () {
                    $linkList = new Denkmal_Paging_Link_All();
                    foreach ($linkList as $link) {
                        /** @var Denkmal_Model_Link $link */
                        try {
                            CM_Util::getContents($link->getUrl());
                            $link->setFailedCount(0);
                        } catch (CM_Exception_Invalid $ex) {
                            $link->setFailedCount($link->getFailedCount() + 1);
                        }
                    }
                },
        ));
    }

    public static function getPackageName() {
        return 'maintenance';
    }
}
