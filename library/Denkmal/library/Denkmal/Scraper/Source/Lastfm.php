<?php

class Denkmal_Scraper_Source_Lastfm extends Denkmal_Scraper_Source_Abstract {

    public function run(Denkmal_Scraper_Manager $manager) {
        $params = array(
            'method'   => 'geo.getevents',
            'location' => 'basel,switzerland',
            'limit'    => 50,
            'api_key'  => $this->_getApiKey(),
        );
        $url = 'http://ws.audioscrobbler.com/2.0/?' . http_build_query($params);
        $content = self::loadUrl($url);

        return $this->processPageDate($content);
    }

    /**
     * @param string        $html
     * @param DateTime|null $now
     * @return Denkmal_Scraper_EventData[]
     */
    public function processPageDate($html, DateTime $now = null) {
        $html = new CM_Dom_NodeList($html, true);
        $eventList = $html->find('events > event');

        return Functional\map($eventList, function (CM_Dom_NodeList $event) use ($now) {
            $venueName = $event->find('venue > name')->getText();

            $dateText = $event->find('startdate')->getText();
            if (!preg_match('#^\w+, (\d+) (\w+) (\d+) (\d+):(\d+):(\d+)$#u', $dateText, $matches)) {
                throw new CM_Exception_Invalid('Cannot detect date from `' . $dateText . '`.');
            }
            $from = new Denkmal_Scraper_Date($matches[1], $matches[2], $matches[3], $now);
            $from->setTime(20, 00); // Time from API is messed up

            $descriptionText = $event->find('description')->getText();
            $descriptionText = preg_replace('/]]>$/', '', $descriptionText);
            $genres = Functional\map($event->find('tags tag'), function (CM_Dom_NodeList $tag) {
                return $tag->getText();
            });
            $artists = Functional\map($event->find('artists artist'), function (CM_Dom_NodeList $artist) {
                return $artist->getText();
            });
            $description = new Denkmal_Scraper_Description(implode(', ', $artists), $descriptionText, new Denkmal_Scraper_Genres($genres));

            return new Denkmal_Scraper_EventData($venueName, $description, $from);
        });
    }
    
    public function getRegion() {
        return Denkmal_Model_Region::getByAbbreviation('BSL');
    }

    /**
     * @return string
     * @throws CM_Exception_Invalid
     */
    private function _getApiKey() {
        $apiKey = (string) self::_getConfig()->apiKey;
        if (empty($apiKey)) {
            throw new CM_Exception_Invalid('apiKey missing');
        }
        return $apiKey;
    }
}
