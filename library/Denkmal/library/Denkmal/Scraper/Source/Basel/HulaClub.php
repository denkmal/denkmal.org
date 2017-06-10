<?php

class Denkmal_Scraper_Source_Basel_HulaClub extends Denkmal_Scraper_Source_Abstract {

    public function run(DateTime $now, array $dateList) {
        $html = self::loadUrl('http://www.hula-club.ch/pages/events.php', 5);
        return $this->processPage($html, $now);
    }

    /**
     * @param string   $html
     * @param DateTime $now
     * @return Denkmal_Scraper_EventData[]
     * @throws CM_Exception
     */
    public function processPage($html, DateTime $now) {
        $html = new CM_Dom_NodeList($html, true);
        $eventList = $html->find('.allevent li');

        return Functional\map($eventList, function (CM_Dom_NodeList $event) use ($now) {
            $text = $event->getText();
            if (!preg_match('#^\s+(\d+)\.(\d+)\.(\d+)\s+(.+?)\s+$#u', $text, $matches)) {
                throw new CM_Exception_Invalid('Cannot parse date.', null, ['string' => $text]);
            }
            $from = new Denkmal_Scraper_Date($matches[1], $matches[2], $matches[3], $now);
            $from->setTime(19, 00);

            $textDescription = $matches[4];
            $genres = null;
            if (preg_match('#^(.+) / (.+?)$#', $textDescription, $matches)) {
                $textDescription = $matches[1];
                $genres = new Denkmal_Scraper_Genres($matches[2]);
            }
            $description = new Denkmal_Scraper_Description($textDescription, null, $genres);

            return new Denkmal_Scraper_EventData($this->getRegion(), 'Hula Club', $description, $from);
        });
    }

    public function getRegion() {
        return Denkmal_Model_Region::getBySlug('basel');
    }

}
