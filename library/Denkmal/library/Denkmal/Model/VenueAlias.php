<?php

class Denkmal_Model_VenueAlias extends CM_Model_Abstract {

	const TYPE = 103;

	/**
	 * @return string
	 */
	public function getName() {
		return (string) $this->_get('name');
	}

	/**
	 * @return Denkmal_Model_Venue
	 */
	public function getVenue() {
		$venueId = $this->_get('venueId');
		return new Denkmal_Model_Venue($venueId);
	}

	protected function _loadData() {
		return CM_Db_Db::select('denkmal_venueAlias', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected function _onDelete() {
		CM_Db_Db::delete('denkmal_venueAlias', array('id' => $this->getId()));
	}

	/**
	 * @param string $name
	 * @return Denkmal_Model_VenueAlias|null
	 */
	public static function findByName($name) {
		$name = (string) $name;
		$venueAliasId = CM_Db_Db::select('denkmal_venueAlias', 'id', array('name' => $name))->fetchColumn();
		if (!$venueAliasId) {
			return null;
		}
		return new self($venueAliasId);
	}

	protected static function _createStatic(array $data) {
		$data = Denkmal_Params::factory($data);

		$name = $data->getString('name');
		$venue = $data->getVenue('venue');

		$id = CM_Db_Db::insert('denkmal_venueAlias', array(
			'name'    => $name,
			'venueId' => $venue->getId(),
		));

		return new static($id);
	}
}
