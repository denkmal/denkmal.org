<?php

class Denkmal_Params extends CM_Params {

	/**
	 * @param string $key
	 * @return Denkmal_Model_Venue
	 * @throws CM_Exception_InvalidParam
	 */
	public function getVenue($key) {
		return $this->_getObject($key, 'Denkmal_Model_Venue');
	}

	/**
	 * @param string $key
	 * @return Denkmal_Model_Event
	 * @throws CM_Exception_InvalidParam
	 */
	public function getEvent($key) {
		return $this->_getObject($key, 'Denkmal_Model_Event');
	}

	/**
	 * @param string $key
	 * @return Denkmal_Model_Song
	 * @throws CM_Exception_InvalidParam
	 */
	public function getSong($key) {
		return $this->_getObject($key, 'Denkmal_Model_Song');
	}

	/**
	 * @param string $key
	 * @return Denkmal_Date
	 */
	public function getDate($key) {
		return $this->_getObject($key, 'Denkmal_Date', null, function ($className, $param) {
			if (!preg_match('#^(\d{4})-(\d{1,2})-(\d{1,2})$#', $param, $matches)) {
				throw new CM_Exception_Invalid('Cannot parse date `' . $param . '`');
			}
			return new Denkmal_Date($matches[3], $matches[2], $matches[1]);
		});
	}

	/**
	 * @param string $key
	 * @return DateInterval
	 */
	public function getDateInterval($key) {
		return $this->_getObject($key, 'DateInterval');
	}
}
