<?php

class Denkmal_Scraper_EventData {

    /** @var Denkmal_Model_Region */
    private $_region;

    /** @var string */
    private $_venueName;

    /** @var Denkmal_Scraper_Description */
    private $_description;

    /** @var DateTime */
    private $_from;

    /** @var DateTime|null */
    private $_until;

    /** @var string[] */
    private $_links = [];

    /** @var string|null */
    private $_sourceIdentifier;

    /**
     * @param Denkmal_Model_Region               $region
     * @param Denkmal_Model_Venue|string         $venue
     * @param Denkmal_Scraper_Description        $description
     * @param DateTime|Denkmal_Scraper_Date      $from
     * @param DateTime|Denkmal_Scraper_Date|null $until
     * @param string|null                        $sourceIdentifier
     * @param string[]|null                      $links
     * @throws CM_Exception_Invalid
     */
    public function __construct(Denkmal_Model_Region $region, $venue, Denkmal_Scraper_Description $description, $from, $until = null, $sourceIdentifier = null, $links = null) {
        $this->_region = $region;

        if ($venue instanceof Denkmal_Model_Venue) {
            $this->_venueName = $venue->getName();
        } else {
            $this->_venueName = (string) $venue;
        }
        $this->_description = $description;

        if ($from instanceof Denkmal_Scraper_Date) {
            $from = $from->getDateTime();
        }
        if (!$from instanceof DateTime) {
            throw new CM_Exception_Invalid('Unexpected `from` of type `' . get_class($from) . '`.');
        }
        $this->_from = $from;

        if ($until instanceof Denkmal_Scraper_Date) {
            $until = $until->getDateTime();
        }
        if (null !== $until) {
            if (!$until instanceof DateTime) {
                throw new CM_Exception_Invalid('Unexpected `until` of type `' . get_class($until) . '`.');
            }
            if ($until && $until < $from) {
                $until->add(new DateInterval('P1D'));
            }
        }
        $this->_until = $until;
        $this->setSourceIdentifier($sourceIdentifier);
        foreach ((array) $links as $label => $url) {
            $this->addLink($label, $url);
        }
    }

    /**
     * @return Denkmal_Model_Region
     */
    public function getRegion() {
        return $this->_region;
    }

    /**
     * @return string
     */
    public function getVenueName() {
        return $this->_venueName;
    }

    /**
     * @return Denkmal_Model_Venue|null
     */
    public function findVenue() {
        return Denkmal_Model_Venue::findByNameOrAlias($this->getRegion(), $this->getVenueName());
    }

    /**
     * @return Denkmal_Scraper_Description
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     * @return DateTime
     */
    public function getFrom() {
        return $this->_from;
    }

    /**
     * @return DateTime|null
     */
    public function getUntil() {
        return $this->_until;
    }

    /**
     * @param string $label
     * @param string $url
     */
    public function addLink($label, $url) {
        $label = (string) $label;
        $url = (string) $url;
        $this->_links[$label] = $url;
    }

    /**
     * @return string[]
     */
    public function getLinks() {
        return $this->_links;
    }

    /**
     * @param string|null $sourceIdentifier
     */
    public function setSourceIdentifier($sourceIdentifier) {
        if (null !== $sourceIdentifier) {
            $sourceIdentifier = (string) $sourceIdentifier;
        }
        $this->_sourceIdentifier = $sourceIdentifier;
    }

    /**
     * @return null|string
     */
    public function getSourceIdentifier() {
        return $this->_sourceIdentifier;
    }

    /**
     * @return bool
     */
    public function hasUntil() {
        return null !== $this->_until;
    }
}
