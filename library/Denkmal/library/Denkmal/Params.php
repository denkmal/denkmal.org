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
     * @param string $key
     * @return Denkmal_Model_Region
     * @throws CM_Exception_InvalidParam
     */
    public function getRegion($key) {
        return $this->getObject($key, 'Denkmal_Model_Region');
    }

    /**
     * @param string        $key
     * @param DateTime|null $default
     * @return DateTime
     */
    public function getDate($key, $default = null) {
        return $this->getObject($key, 'DateTime', $default, function ($className, $param) {
            if (!preg_match('#^(\d{4})-(\d{1,2})-(\d{1,2})$#', $param, $matches)) {
                throw new CM_Exception_InvalidParam('Cannot parse date.', null, ['date' => $param]);
            }
            if (!checkdate($matches[2], $matches[3], $matches[1])) {
                throw new CM_Exception_InvalidParam('Not a valid date.', null, ['date' => $param]);
            }
            return new $className($matches[3] . '-' . $matches[2] . '-' . $matches[1]);
        });
    }

    /**
     * @param string             $key
     * @param CM_Model_User|null $default
     * @throws CM_Exception_Invalid
     * @throws CM_Exception_InvalidParam
     * @return Denkmal_Model_User
     */
    public function getUser($key, CM_Model_User $default = null) {
        $param = parent::getUser($key, $default);
        if (!$param instanceof Denkmal_Model_User) {
            throw new CM_Exception_Invalid('Not a Denkmal_Model_User');
        }
        return $param;
    }

    /**
     * @param string $key
     * @return DateInterval
     */
    public function getDateInterval($key) {
        return $this->getObject($key, 'DateInterval');
    }

    /**
     * @param string $key
     * @return Denkmal_Model_Message
     * @throws CM_Exception_InvalidParam
     */
    public function getMessage($key) {
        return $this->getObject($key, 'Denkmal_Model_Message');
    }

    /**
     * @param string $key
     * @return Denkmal_Model_UserInvite
     * @throws CM_Exception_InvalidParam
     */
    public function getUserInvite($key) {
        return $this->getObject($key, 'Denkmal_Model_UserInvite');
    }
}
