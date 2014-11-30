<?php

class Denkmal_Scraper_Manager extends CM_Class_Abstract {

    /** @var CM_OutputStream_Interface */
    private $_output;

    /**
     * @param CM_OutputStream_Interface|null $output
     */
    public function __construct(CM_OutputStream_Interface $output = null) {
        if (null === $output) {
            $output = new CM_OutputStream_Null();
        }
        $this->_output = $output;
    }

    public function process() {
        $scraperList = array(
            new Denkmal_Scraper_Source_Kaschemme(),
            new Denkmal_Scraper_Source_Programmzeitung(),
            new Denkmal_Scraper_Source_Hinterhof(),
            new Denkmal_Scraper_Source_Fingerzeig(),
            new Denkmal_Scraper_Source_Lastfm(),
            new Denkmal_Scraper_Source_Saali(),
        );

        foreach ($scraperList as $scraper) {
            $this->_output->writeln('Running scraper `' . get_class($scraper) . '`…');
            $this->_processScraper($scraper);
        }
    }

    /**
     * @return DateTime
     */
    public function getNow() {
        return Denkmal_Site::getCurrentDate();
    }

    /**
     * @return int
     */
    public function getDayCount() {
        return (int) self::_getConfig()->dayCount;
    }

    /**
     * @return DateTime[]
     */
    public function getDateList() {
        $day = new DateInterval('P1D');
        $dayCount = $this->getDayCount();
        $dateList = array();
        $date = Denkmal_Site::getCurrentDate();
        for ($i = 0; $i < $dayCount; $i++) {
            $dateList[] = clone $date;
            $date->add($day);
        }
        return $dateList;
    }

    /**
     * @param Denkmal_Scraper_Source_Abstract $scraper
     */
    protected function _processScraper(Denkmal_Scraper_Source_Abstract $scraper) {
        $eventDataList = $scraper->run($this);
        foreach ($eventDataList as $eventData) {
            if ($this->_isValidEvent($eventData)) {
                if (!$venue = $eventData->findVenue()) {
                    $venue = Denkmal_Model_Venue::create($eventData->getVenueName(), true, false);
                }
                Denkmal_Model_Event::create($venue, $eventData->getDescription()->getAll(), true, true, $eventData->getFrom(), $eventData->getUntil());
            }
        }
    }

    /**
     * @param Denkmal_Scraper_EventData $eventData
     * @return bool
     */
    protected function _isValidEvent(Denkmal_Scraper_EventData $eventData) {
        if ($eventData->getFrom() < $this->getNow()) {
            return false; // From-date is in the past
        }

        $fromMax = clone $this->getNow();
        $fromMax->add(new DateInterval('P' . $this->getDayCount() . 'D'));
        if ($eventData->getFrom() > $fromMax) {
            return false; // From-date is too far in the future
        }

        if ($eventData->hasUntil()) {
            if ($eventData->getUntil() < $eventData->getFrom()) {
                return false; // Until-date is before from-date
            }
        }

        if ($venue = $eventData->findVenue()) {
            if ($venue->getIgnore()) {
                return false; // Venue ignored
            }

            $eventListVenueDate = new Denkmal_Paging_Event_VenueDate($eventData->getFrom(), $venue);
            if ($eventListVenueDate->getCount()) {
                return false; // Venue has event on same day
            }
        }

        return true;
    }
}
