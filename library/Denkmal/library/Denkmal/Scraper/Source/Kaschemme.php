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
        $regexp = '(?<weekday>\w+)\s+(?<day>\d+)\.(?<month>\d+)\.(?<year>\d+)\s+(?<title>.+?)\s*<br>(?<description>.+?)?\.{4,}';
        preg_match_all('#' . $regexp . '#u', $eventHtml, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $from = new Denkmal_Scraper_Date($match['day'], $match['month'], $match['year']);
            $from->setTime(22);

            $title = $this->_parseText($match['title']);
            $descriptionList = explode('<br>', $match['description']);
            $descriptionList = Functional\map($descriptionList, function ($descriptionItem) {
                return $this->_parseText($descriptionItem);
            });
            $descriptionList = array_filter($descriptionList);

            $genres = null;
            foreach ($descriptionList as $i => $descriptionItem) {
                if (preg_match('#^Sounds Like\s*: \(?(?<genres>.+?)\)?$#ui', $descriptionItem, $matchesGenres)) {
                    $genres = new Denkmal_Scraper_Genres($matchesGenres['genres']);
                    unset($descriptionList[$i]);
                }
            }

            $description = implode(', ', $descriptionList);

            $title = $this->_parseText($title);
            $description = $this->_parseText($description);
            if (empty($description)) {
                $description = $title;
                $title = null;
            }

            $this->_addEventAndVenue(
                $venueName,
                new Denkmal_Scraper_Description($description, $title, $genres),
                $from->getDateTime()
            );
        }
    }

    /**
     * @param string $text
     * @return string
     */
    private function _parseText($text) {
        $text = html_entity_decode($text);
        $text = preg_replace('#^///\s*#', '', $text);
        $text = preg_replace('#\s*///$#', '', $text);
        $text = trim($text);
        return $text;
    }
}
