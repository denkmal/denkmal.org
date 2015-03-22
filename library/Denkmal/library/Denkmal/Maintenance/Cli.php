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

        $this->_registerClockworkCallbacks('12 hours', array(
            'Scraper' => function () {
                $scraperManager = new Denkmal_Scraper_Manager($this->_getStreamOutput());
                $scraperManager->process(true);
            }
        ));

        $this->_registerClockworkCallbacks('18:00', array(
            'Daily event tweets' => function () {
                $serviceManager = CM_Service_Manager::getInstance();
                /** @var Denkmal_Twitter_Client $twitter */
                $twitter = $serviceManager->get('twitter', 'Denkmal_Twitter_Client');

                $eventTweeter = new Denkmal_Twitter_EventTweeter($twitter, new CM_Frontend_Render());
                $eventTweeter->tweetStarredEvents(Denkmal_Site::getCurrentDate());
            }
        ));

        $this->_registerClockworkCallbacks('1 hour', array(
            'Delete expired invites' => function () {
                /** @var Denkmal_Model_UserInvite $userInvite */
                foreach ((new Denkmal_Paging_UserInvite_Expired())->getItems() as $userInvite) {
                    $userInvite->delete();
                }
            }
        ));
    }

    public static function getPackageName() {
        return 'maintenance';
    }
}
