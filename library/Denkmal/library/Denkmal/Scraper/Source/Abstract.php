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
     * @param Denkmal_Model_Venue|string $venue       Location-name
     * @param string                     $description Description
     * @param DateTime                   $from        From-date
     * @param DateTime|null              $until       Until-date
     */
    protected function _addEventAndVenue($venue, $description, DateTime $from, DateTime $until = null) {
        if ($venue instanceof Denkmal_Model_Venue) {
            $venueName = $venue->getName();
        } else {
            $venueName = (string) $venue;
            $venue = Denkmal_Model_Venue::findByNameOrAlias($venueName);
        }
        $description = new Denkmal_Scraper_Description($description);
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

            $eventListVenueDate = new Admin_Paging_Event_VenueDate($from, $venue);
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
     * @return Denkmal_Scraper_Source_Abstract[]
     */
    public static function getAll() {
        $scraperList = array();
        foreach (CM_Util::getClassChildren('Denkmal_Scraper_Source_Abstract') as $className) {
            $scraperList[] = new $className;
        }
        return $scraperList;
    }
}
