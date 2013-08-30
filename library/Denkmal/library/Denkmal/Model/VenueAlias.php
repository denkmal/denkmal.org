<?php

class Denkmal_Model_VenueAlias extends CM_Model_Abstract {

	const TYPE = 103;

	/**
	 * @return string
	 */
	public function getName() {
		return $this->_get('name');
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->_set('name', $name);
	}

	/**
	 * @return Denkmal_Model_Venue
	 */
	public function getVenue() {
		return new Denkmal_Model_Venue($this->_get('venueId'));
	}

	/**
	 * @param Denkmal_Model_Venue $venue
	 */
	public function setVenue(Denkmal_Model_Venue $venue) {
		$this->_set('venueId', $venue->getId());
	}

	/**
	 * @param Denkmal_Model_Venue $venue
	 * @param string              $name
	 */
	public function create(Denkmal_Model_Venue $venue, $name) {
		$this->setVenue($venue);
		$this->setName($name);
		$this->commit();
	}

	protected function _getSchema() {
		return new CM_Model_Schema_Definition(array(
			'name'    => array('type' => 'string'),
			'venueId' => array('type' => 'int'),
		));
	}

	/**
	 * @param string $name
	 * @return Denkmal_Model_VenueAlias|null
	 */
	public static function findByName($name) {
		$name = (string) $name;
		$venueAliasId = CM_Db_Db::select('denkmal_model_venuealias', 'id', array('name' => $name))->fetchColumn();
		if (!$venueAliasId) {
			return null;
		}
		return new self($venueAliasId);
	}

	public static function getPersistenceClass() {
		return 'CM_Model_StorageAdapter_Database';
	}
}
