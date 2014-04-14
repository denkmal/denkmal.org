<?php

class Denkmal_Scraper_Source_Hinterhof extends Denkmal_Scraper_Source_Abstract {

    public function run() {
        $html = self::loadUrl('http://hinterhof.ch/programm/');

        $this->processPage($html);
    }

    /**
     * @param string $html
     * @throws CM_Exception_Invalid
     */
    public function processPage($html) {
        $html = new CM_Dom_NodeList($html, true);
        $eventList = $html->find('.events > .entry');
        /** @var CM_Dom_NodeList $event */
        foreach ($eventList as $i => $event) {
            $textWeekday = $event->find('.summary .weekday')->getText();
            if (!preg_match('#^\w+ (?<day>\d+)\.(?<month>\d+) -\s*?(?<titleAndGenres>.+?)?$#u', $textWeekday, $matches)) {
                throw new CM_Exception_Invalid('Cannot parse `weekday` from `' . $textWeekday . '`.');
            }
            $title = null;
            $genres = null;
            $day = $matches['day'];
            $month = $matches['month'];
            $titleAndGenres = trim($matches['titleAndGenres']);
            if (!empty($titleAndGenres)) {
                if (!preg_match('#(?<title>.*?)?( - )?((?<genres>[^-]+))?$#u', $titleAndGenres, $titleAndGenresMatch)) {
                    throw new CM_Exception_Invalid('Cannot parse `titleAndGenres` from `' . $titleAndGenres . '`.');
                }
                if (!empty($titleAndGenresMatch['title'])) {
                    $title = $titleAndGenresMatch['title'];
                }
                if (!empty($titleAndGenresMatch['genres'])) {
                    $genres = new Denkmal_Scraper_Genres($titleAndGenresMatch['genres']);
                }
            }

            $textTitle = $event->find('.summary .title')->getText();

            $description = new Denkmal_Scraper_Description($textTitle, $title, $genres);

            $from = new Denkmal_Scraper_Date($matches['day'], $matches['month']);
            if ($from->getWeekday() == 6) {
                $from->setTime(23); // Sa
            } else {
                $from->setTime(20);
            }

            $this->_addEventAndVenue(
                'Hinterhof',
                $description,
                $from->getDateTime()
            );
        }
    }
}
