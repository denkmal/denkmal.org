<?php

class Denkmal_EventTweeter_Daily {

    /**
     * @param DateTime $date
     */
    public function run(DateTime $date) {
        $regionList = new Denkmal_Paging_Region_All();
        /** @var Denkmal_Model_Region $region */
        foreach ($regionList as $region) {
            $tweeter = $this->_getEventTweeter($region);
            if (!$tweeter) {
                continue;
            }

            $eventList = (new Denkmal_Paging_Event_Date($region, $date))->getItems();
            $eventList = Functional\filter($eventList, function (Denkmal_Model_Event $event) {
                return $event->getStarred();
            });
            $eventList = array_slice($eventList, 0, 3);

            foreach ($eventList as $event) {
                $tweeter->sendTweet($event);
            }
        }
    }

    /**
     * @param Denkmal_Model_Region $region
     * @return Denkmal_EventTweeter_EventTweeter|null
     */
    protected function _getEventTweeter(Denkmal_Model_Region $region) {
        $twitterCredentials = $region->getTwitterCredentials();
        if (!$twitterCredentials) {
            return null;
        }
        $twitterClient = new Denkmal_Twitter_Client($twitterCredentials);
        $site = Denkmal_Site_Region_Abstract::findSiteByRegion($region);
        $render = new CM_Frontend_Render(new CM_Frontend_Environment($site));
        return new Denkmal_EventTweeter_EventTweeter($twitterClient, $render);
    }
}
