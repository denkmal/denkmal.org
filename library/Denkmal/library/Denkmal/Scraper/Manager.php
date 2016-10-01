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

    /**
     * @param bool|null $storeResults
     */
    public function process($storeResults = null) {
        foreach ($this->getScraperList() as $scraper) {
            $this->_output->write('Running scraper `' . get_class($scraper) . '`… ');
            $result = $this->_processScraper($scraper);
            if ($result->getError()) {
                $this->_output->writeln('Error: `' . $result->getError()->getMessage() . '`.');
            } else {
                $this->_output->writeln($result->getEventDataCount() . ' events processed.');
            }
            if ($storeResults) {
                $result->commit();
            }
        }
    }

    /**
     * @return Denkmal_Scraper_Source_Abstract[]
     */
    public function getScraperList() {
        return array(
            new Denkmal_Scraper_Source_Kaschemme(),
            new Denkmal_Scraper_Source_Programmzeitung(),
            new Denkmal_Scraper_Source_Hinterhof(),
            new Denkmal_Scraper_Source_Fingerzeig(),
            new Denkmal_Scraper_Source_Saali(),
            new Denkmal_Scraper_Source_Apawi(),
            new Denkmal_Scraper_Source_Graz_Postgarage(),
            new Denkmal_Scraper_Source_Graz_Sub(),
            new Denkmal_Scraper_Source_Facebook(),
        );
    }

    /**
     * @return DateTime
     */
    public function getNow() {
        $settings = new Denkmal_App_Settings();
        return $settings->getCurrentDate();
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
        $date = $this->getNow();
        for ($i = 0; $i < $dayCount; $i++) {
            $dateList[] = clone $date;
            $date->add($day);
        }
        return $dateList;
    }

    /**
     * @param Denkmal_Scraper_Source_Abstract $source
     * @return Denkmal_Scraper_SourceResult
     */
    protected function _processScraper(Denkmal_Scraper_Source_Abstract $source) {
        $result = new Denkmal_Scraper_SourceResult();
        $result->setScraperSource($source);
        $result->setCreated(new DateTime());

        try {
            $eventList = $source->run($this->getDateList());

            /** @var Denkmal_Scraper_EventData[] $eventListValid */
            $eventListValid = Functional\select($eventList, function (Denkmal_Scraper_EventData $eventData) {
                return $this->_isValidEvent($eventData);
            });

            foreach ($eventListValid as $eventData) {
                if (!$this->_isExistingEvent($eventData)) {
                    $this->_createEvent($eventData);
                }
            }

            $result->setEventDataCount(count($eventListValid));
            $result->setError(null);
        } catch (Exception $e) {
            $result->setEventDataCount(0);
            $result->setError(new CM_ExceptionHandling_SerializableException($e));
        }

        return $result;
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

            $eventListVenueDate = new Denkmal_Paging_Event_EventDuplicates($eventData->getFrom(), $venue);
            if ($eventListVenueDate->getCount()) {
                return false; // Venue has event on same day
            }
        } else {
            if ('' === trim($eventData->getVenueName())) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Denkmal_Scraper_EventData $eventData
     * @return bool
     */
    protected function _isExistingEvent(Denkmal_Scraper_EventData $eventData) {
        if ($venue = $eventData->findVenue()) {
            $eventListVenueDate = new Denkmal_Paging_Event_EventDuplicates($eventData->getFrom(), $venue);
            if ($eventListVenueDate->getCount()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Denkmal_Scraper_EventData $eventData
     */
    protected function _createEvent(Denkmal_Scraper_EventData $eventData) {
        if (!$venue = $eventData->findVenue()) {
            $venue = Denkmal_Model_Venue::create($eventData->getVenueName(), true, false, $eventData->getRegion());
        }
        Denkmal_Model_Event::create($venue, $eventData->getDescription()->getAll(), true, true, $eventData->getFrom(), $eventData->getUntil());
    }

}
