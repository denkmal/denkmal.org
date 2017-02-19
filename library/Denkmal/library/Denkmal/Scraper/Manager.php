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
            $result = $this->processScraper($scraper);
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
        return [
            new Denkmal_Scraper_Source_Kaschemme(),
            new Denkmal_Scraper_Source_Programmzeitung(),
            new Denkmal_Scraper_Source_Hinterhof(),
            new Denkmal_Scraper_Source_Fingerzeig(),
            new Denkmal_Scraper_Source_Saali(),
            new Denkmal_Scraper_Source_Apawi(),
            new Denkmal_Scraper_Source_Basel_Renee(),
            new Denkmal_Scraper_Source_Graz_Postgarage(),
            new Denkmal_Scraper_Source_Graz_Sub(),
            new Denkmal_Scraper_Source_Facebook_Venues(),
            new Denkmal_Scraper_Source_Facebook_PageList(),
        ];
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
    public function processScraper(Denkmal_Scraper_Source_Abstract $source) {
        $result = new Denkmal_Scraper_SourceResult();
        $result->setScraperSource($source);
        $result->setCreated(new DateTime());

        try {
            $eventList = $source->run($this->getNow(), $this->getDateList());

            /** @var Denkmal_Scraper_EventData[] $eventList */
            $eventList = Functional\select($eventList, function (Denkmal_Scraper_EventData $eventData) {
                return $this->_isValidEvent($eventData);
            });

            $eventListGrouped = Functional\group($eventList, function (Denkmal_Scraper_EventData $eventData) {
                return $eventData->getSourceIdentifier();
            });

            // Create events
            foreach ($eventListGrouped as $sourceIdentifier => $eventListSource) {
                $eventListCreate = Functional\reject($eventListSource, function (Denkmal_Scraper_EventData $eventData) {
                    return $this->_hasExistingEvent($eventData);
                });

                foreach ($eventListCreate as $eventData) {
                    $this->_createEvent($eventData);
                }
            }

            // Update existing events using data from other scrapers
            foreach ($eventList as $eventData) {
                if ($existingEvent = $this->_findExistingEvent($eventData)) {
                    $this->_updateExistingEvent($existingEvent, $eventData);
                }
            }

            $result->setEventDataCount(count($eventList));
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
    protected function _hasExistingEvent(Denkmal_Scraper_EventData $eventData) {
        return count($this->_getExistingEvents($eventData)) > 0;
    }

    /**
     * @param Denkmal_Scraper_EventData $eventData
     * @return Denkmal_Model_Event
     */
    protected function _findExistingEvent(Denkmal_Scraper_EventData $eventData) {
        $existingEvents = $this->_getExistingEvents($eventData);
        if (1 !== count($existingEvents)) {
            return null;
        }
        return \Functional\first($existingEvents);
    }

    /**
     * @param Denkmal_Scraper_EventData $eventData
     * @return Denkmal_Model_Event[]
     */
    protected function _getExistingEvents(Denkmal_Scraper_EventData $eventData) {
        if ($venue = $eventData->findVenue()) {
            $eventListVenueDate = new Denkmal_Paging_Event_EventDuplicates($eventData->getFrom(), $venue);
            return $eventListVenueDate->getItems();
        }
        return [];
    }

    /**
     * @param Denkmal_Scraper_EventData $eventData
     */
    protected function _createEvent(Denkmal_Scraper_EventData $eventData) {
        if (!$venue = $eventData->findVenue()) {
            $venue = Denkmal_Model_Venue::create($eventData->getVenueName(), true, false, $eventData->getRegion());
        }
        $event = Denkmal_Model_Event::create($venue, $eventData->getDescription()->getAll(), true, true, $eventData->getFrom(), $eventData->getUntil());
        foreach ($eventData->getLinks() as $label => $url) {
            Denkmal_Model_EventLink::create($event, $label, $url);
        }
    }

    /**
     * @param Denkmal_Model_Event       $existingEvent
     * @param Denkmal_Scraper_EventData $eventData
     */
    protected function _updateExistingEvent(Denkmal_Model_Event $existingEvent, Denkmal_Scraper_EventData $eventData) {
        foreach ($eventData->getLinks() as $label => $url) {
            $existingEvent->addLinkIfNotExists($label, $url);
        }
    }

}
