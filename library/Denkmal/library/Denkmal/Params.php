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
}
