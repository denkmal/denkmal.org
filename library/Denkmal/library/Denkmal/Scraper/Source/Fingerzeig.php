<?php

class Denkmal_Scraper_Source_Fingerzeig extends Denkmal_Scraper_Source_Abstract {

    public function run(Denkmal_Scraper_Manager $manager) {
        $calendarPage = new CM_Dom_NodeList(self::loadUrl('http://fingerzeig.ch/parties/'), true);

        $dateListExisting = Functional\filter($manager->getDateList(), function (DateTime $date) use ($calendarPage) {
            return $calendarPage->has('a[href="/parties/' . $date->format('Y/m/d') . '"]');
        });
        if (0 === count($dateListExisting)) {
            throw new CM_Exception_Invalid('Cannot find any calendar days with events');
        }

        return Functional\flatten(Functional\map($dateListExisting, function (DateTime $date) {
            $dateStr = $date->format('Y/m/d');
            $url = 'http://fingerzeig.ch/parties/' . $dateStr . '/';
            $content = self::loadUrl($url);

            return $this->processPageDate($content, $date);
        }));
    }

    /**
     * @param string        $html
     * @param DateTime      $date
     * @param DateTime|null $now
     * @return Denkmal_Scraper_EventData[]
     */
    public function processPageDate($html, DateTime $date, DateTime $now = null) {
        $html = new CM_Dom_NodeList($html, true);
        $eventList = $html->find('#content .box');

        return Functional\map($eventList, function (CM_Dom_NodeList $event) use ($date, $now) {
            $dateText = $event->find('.right-big')->getText();
            if (!preg_match('#^\w+\s+(\d+)\.(\d+)\.(\d+),\s+(\d{1,2}):(\d{2})$#u', $dateText, $matches)) {
                throw new CM_Exception_Invalid('Cannot detect date from `' . $dateText . '`.');
            }
            if ($matches[1] != $date->format('d') || $matches[2] != $date->format('m') || $matches[3] != $date->format('Y')) {
                throw new CM_Exception_Invalid('Date on page `' . $dateText . '` doesnt match expected date `' . $date->format('Y-m-d') . '`.');
            }
            $from = new Denkmal_Scraper_Date($date, null, null, $now);
            $from->setTime($matches[4], $matches[5]);

            $venueAndGenresText = $event->find('.left')->getText();
            if (!preg_match('#^Where:\s+(.+)\s+Genre:\s+(.+)$#u', $venueAndGenresText, $matches)) {
                throw new CM_Exception_Invalid('Cannot detect venue and genres from `' . $venueAndGenresText . '`.');
            }
            $venueName = trim($matches[1]);
            $genres = new Denkmal_Scraper_Genres($matches[2]);
            $titleText = $event->find('.title')->getText();
            $description = new Denkmal_Scraper_Description($titleText, null, $genres);

            return new Denkmal_Scraper_EventData($venueName, $description, $from);
        });
    }
}
