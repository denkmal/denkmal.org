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
     */
    public function processPageDate($html, DateTime $date) {
        $html = new CM_Dom_NodeList($html, true);
        $eventList = $html->find('.contentrahmen');
        /** @var CM_Dom_NodeList $event */
        foreach ($eventList as $event) {
            $eventText = $event->find('.veranstaltung');
            $locationName = $eventText->find('b')->getText();
            $description = $eventText->getChildren(XML_TEXT_NODE)->getText();

            $time = $event->find('.zeit')->getText();
            preg_match('#(\d+)\.(\d+)(\s+.\s+(\d+)\.(\d+))?#', $time, $matches);
            $from = new Denkmal_Scraper_Date($date);
            $from->setTime($matches[1], $matches[2]);

            $until = null;
            if (isset($matches[4]) && isset($matches[5])) {
                $until = clone $from;
                $until->setTime($matches[4], $matches[5]);
            }

            $this->_addEventAndVenue(
                $locationName,
                $description,
                $from->getDateTime(),
                $until ? $until->getDateTime() : null
            );
        }
    }
}
