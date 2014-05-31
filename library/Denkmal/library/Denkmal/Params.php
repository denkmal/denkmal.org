<?php

class Denkmal_Params extends CM_Params {

    /**
     * @param string $key
     * @return Denkmal_Model_Venue
     * @throws CM_Exception_InvalidParam
     */
    public function getVenue($key) {
        return $this->getObject($key, 'Denkmal_Model_Venue');
    }

    /**
     * @param string $key
     * @return Denkmal_Model_Venue
     * @throws CM_Exception_InvalidParam
     */
    public function getVenueAlias($key) {
        return $this->getObject($key, 'Denkmal_Model_VenueAlias');
    }

    /**
     * @param string $key
     * @return Denkmal_Model_Event
     * @throws CM_Exception_InvalidParam
     */
    public function getEvent($key) {
        return $this->getObject($key, 'Denkmal_Model_Event');
    }

    /**
     * @param string $key
     * @return Denkmal_Model_Link
     * @throws CM_Exception_InvalidParam
     */
    public function getLink($key) {
        return $this->getObject($key, 'Denkmal_Model_Link');
    }

    /**
     * @param string $key
     * @return Denkmal_Model_Song
     * @throws CM_Exception_InvalidParam
     */
    public function getSong($key) {
        return $this->getObject($key, 'Denkmal_Model_Song');
    }

    /**
     * @param string        $key
     * @param DateTime|null $default
     * @return DateTime
     */
    public function getDate($key, $default = null) {
        return $this->getObject($key, 'DateTime', $default, function ($className, $param) {
            if (!preg_match('#^(\d{4})-(\d{1,2})-(\d{1,2})$#', $param, $matches)) {
                throw new CM_Exception_InvalidParam('Cannot parse date `' . $param . '`');
            }
            if (!checkdate($matches[2], $matches[3], $matches[1])) {
                throw new CM_Exception_InvalidParam('Not a valid date: `' . $param . '`');
            }
            return new $className($matches[3] . '-' . $matches[2] . '-' . $matches[1]);
        });
    }

    /**
     * @param string $key
     * @return DateInterval
     */
    public function getDateInterval($key) {
        return $this->getObject($key, 'DateInterval');
    }
}
