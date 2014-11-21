<?php

class Denkmal_Maintenance_Cli extends CM_Maintenance_Cli {

    /**
     * @synchronized
     */
    protected function _registerCallbacks() {
        parent::_registerCallbacks();

        $this->_registerClockworkCallbacks('12 hours', array(
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
                }
        ));

        /** @var Denkmal_Scraper_Source_Abstract $scraper */
        foreach (new Denkmal_Paging_ScraperSource_All() as $scraper) {
            $this->_registerClockworkCallbacks('12 hours', array(
                'Scraper: ' . get_class($scraper) => function () use ($scraper) {
                        $scraper->run();
                    }
            ));
        }

        $this->_registerClockworkCallbacks('18:00', array(
            'Daily event tweets' => function () {
                $serviceManager = CM_Service_Manager::getInstance();
                /** @var Denkmal_Twitter_Client $twitter */
                $twitter = $serviceManager->get('twitter', 'Denkmal_Twitter_Client');

                $eventTweeter = new Denkmal_Twitter_EventTweeter($twitter, new CM_Frontend_Render());
                $eventTweeter->tweetStarredEvents(Denkmal_Site::getCurrentDate());
            }
        ));
    }

    public static function getPackageName() {
        return 'maintenance';
    }
}
