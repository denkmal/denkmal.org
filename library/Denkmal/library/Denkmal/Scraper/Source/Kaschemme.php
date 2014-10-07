<?php

class Denkmal_Scraper_Source_Kaschemme extends Denkmal_Scraper_Source_Abstract {

    public function run() {
        $html = self::loadUrl('http://www.kaschemme.ch/Programm');

        $this->processPage($html);
    }

    /**
     * @param string $html
     * @throws CM_Exception_Invalid
     */
    public function processPage($html) {
        $html = new CM_Dom_NodeList($html, true);
        $venueName = 'Kaschemme';
        $eventHtml = $html->find('#maincontainer .project_content')->getHtml();
        $regexp = '(?<weekday>\w+)\s+(?<day>\d+)\.(?<month>\d+)\.(?<year>\d+)\s+(?<description>.+?)\s+(?<hour>\d+)h\s*<br';
        preg_match_all('#' . $regexp . '#u', $eventHtml, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $from = new Denkmal_Scraper_Date($match['day'], $match['month'], $match['year']);
            $from->setTime($match['hour']);
            $description = $match['description'];
            $description = html_entity_decode($description);
            $description = preg_replace('#^///\s*#', '', $description);
            $description = preg_replace('#\s*///$#', '', $description);

            $this->_addEventAndVenue(
                $venueName,
                new Denkmal_Scraper_Description($description, null),
                $from->getDateTime()
            );
        }
    }
}
