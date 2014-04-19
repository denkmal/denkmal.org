<?php

abstract class Denkmal_Scraper_Source_Abstract extends CM_Class_Abstract {

    abstract public function run();

    /**
     * @return DateTime[]
     */
    protected function _getDateList() {
        $day = new DateInterval('P1D');
        $dayCount = $this->_getDayCount();
        $dateList = array();
        $date = Denkmal_Site::getCurrentDate();
        for ($i = 0; $i < $dayCount; $i++) {
            $dateList[] = clone $date;
            $date->add($day);
        }
        return $dateList;
    }

    /**
     * @param Denkmal_Model_Venue|string  $venue
     * @param Denkmal_Scraper_Description $description
     * @param DateTime                    $from
     * @param DateTime|null               $until
     */
    protected function _addEventAndVenue($venue, Denkmal_Scraper_Description $description, DateTime $from, DateTime $until = null) {
        if ($venue instanceof Denkmal_Model_Venue) {
            $venueName = $venue->getName();
        } else {
            $venueName = (string) $venue;
            $venue = Denkmal_Model_Venue::findByNameOrAlias($venueName);
        }
        if ($until && $until < $from) {
            $until->add(new DateInterval('P1D'));
        }

        if ($this->_isValidEvent($venue, $description, $from, $until)) {
            if (null === $venue) {
                $venue = Denkmal_Model_Venue::create($venueName, true, false);
            }
            Denkmal_Model_Event::create($venue, $description->getDescriptionAndGenres(), true, true, $from, $until, $description->getTitle(), null);
        }
    }

    /**
     * @param Denkmal_Model_Venue|null           $venue
     * @param Denkmal_Scraper_Description|string $description
     * @param DateTime                           $from
     * @param DateTime                           $until
     * @return bool
     */
    protected function _isValidEvent($venue, Denkmal_Scraper_Description $description, DateTime $from, DateTime $until = null) {
        $now = Denkmal_Site::getCurrentDate();
        if ($from < $now) {
            return false; // From-date is in the past
        }

        $fromMax = clone $now;
        $fromMax->add(new DateInterval('P' . $this->_getDayCount() . 'D'));
        if ($from > $fromMax) {
            return false; // From-date is too far in the future
        }

        if ($until) {
            if ($until < $from) {
                return false; // Until-date is before from-date
            }
        }

        if ($venue instanceof Denkmal_Model_Venue) {
            if ($venue->getIgnore()) {
                return false; // Venue ignored
            }

            $eventListVenueDate = new Denkmal_Paging_Event_VenueDate($from, $venue);
            if ($eventListVenueDate->getCount()) {
                return false; // Venue has event on same day
            }
        }

        return true;
    }

    /**
     * @return int
     */
    protected function _getDayCount() {
        return (int) self::_getConfig()->dayCount;
    }

    /**
     * @param string $url
     * @return string Content
     */
    public static function loadUrl($url) {
        $context = stream_context_create(array('http' => array('ignore_errors' => true, 'header' => "Content-Type: text/xml; charset=utf-8")));
        $content = file_get_contents($url, null, $context);

        return self::_fixEncoding($content);
    }

    /**
     * @param string $path
     * @return string
     */
    public static function loadFile($path) {
        $file = new CM_File($path);

        return self::_fixEncoding($file->read());
    }

    /**
     * @return Denkmal_Scraper_Source_Abstract[]
     */
    public static function getAll() {
        $scraperList = array();
        foreach (CM_Util::getClassChildren('Denkmal_Scraper_Source_Abstract') as $className) {
            $scraperList[] = new $className;
        }
        return $scraperList;
    }

    /**
     * @param string $content
     * @return string
     */
    private static function _fixEncoding($content) {
        $content = preg_replace('#<meta[^>]+charset[^>]+>#i', '', $content);
        $encoding = mb_detect_encoding($content, 'UTF-8, ISO-8859-1');
        $content = mb_convert_encoding($content, 'UTF-8', $encoding);
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
        $content = preg_replace('/\r?\n\r?/', ' ', $content);
        $content = preg_replace('/[\xA0]/u', ' ', $content); // Replace '&nbsp' with ' '

        return $content;
    }
}
