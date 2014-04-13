<?php

class Denkmal_Scraper_Source_Programmzeitung extends Denkmal_Scraper_Source_Abstract {

    public function run() {
        foreach ($this->_getDateList() as $date) {
            $dateStr = $date->format('d.m.Y');
            $url = 'http://www.programmzeitung.ch/index.cfm?Datum_von=' . $dateStr . '&Datum_bis=' .
                $dateStr . '&Rubrik=6&uuid=2BCD9733D9D9424C4EF093B3E35CB44B';
            $content = self::loadUrl($url);

            $this->processPageDate($content, $date);
        }
    }

    /**
     * @param string   $html
     * @param DateTime $date
     * @throws CM_Exception_Invalid
     */
    public function processPageDate($html, DateTime $date) {
        $html = new CM_Dom_NodeList($html, true);
        $eventList = $html->find('.contentrahmen');
        /** @var CM_Dom_NodeList $event */
        foreach ($eventList as $event) {
            $eventText = $event->find('.veranstaltung');
            $eventTitle = $eventText->find('b')->getText();
            $eventDescription = $eventText->getChildren(XML_TEXT_NODE)->getText();

            $venueText = $event->find('.ort')->getText();
            if (!preg_match('#^(.+?)(\[.+?\].*?)?(,.*?)?$#u', $venueText, $matches)) {
                throw new CM_Exception_Invalid('Cannot detect venue from `' . $venueText . '`.');
            }
            $venueName = strip_tags($matches[1]);

            $timeText = $event->find('.zeit')->getText();
            if (0 === strlen(trim($timeText))) {
                continue; // Missing time
            }
            if (!preg_match('#^(\d+)\.(\d+)(\s+.\s+(\d+)\.(\d+))?$#u', $timeText, $matches)) {
                throw new CM_Exception_Invalid('Cannot detect time from `' . $timeText . '`.');
            }
            $from = new Denkmal_Scraper_Date($date);
            $from->setTime($matches[1], $matches[2]);

            $until = null;
            if (isset($matches[4]) && isset($matches[5])) {
                $until = clone $from;
                $until->setTime($matches[4], $matches[5]);
            }

            $this->_addEventAndVenue(
                $venueName,
                $eventTitle,
                $eventDescription,
                $from->getDateTime(),
                $until ? $until->getDateTime() : null
            );
        }
    }
}
