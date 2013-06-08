<?php

class Denkmal_Model_Venue extends CM_Model_Abstract {

	const TYPE = 100;

	/**
	 * @return string
	 */
	public function getName() {
		return (string) $this->_get('name');
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$name = (string) $name;
		CM_Db_Db::update('denkmal_venue', array('name' => $name), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string|null
	 */
	public function getUrl() {
		$url = $this->_get('url');
		if (null === $url) {
			return null;
		}
		return (string) $url;
	}

	/**
	 * @param string|null $url
	 */
	public function setUrl($url) {
		$url = isset($url) ? (string) $url : null;
		CM_Db_Db::update('denkmal_venue', array('url' => $url), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string|null
	 */
	public function getAddress() {
		$address = $this->_get('address');
		if (null === $address) {
			return null;
		}
		return (string) $address;
	}

	/**
	 * @param string|null $address
	 */
	public function setAddress($address) {
		$address = isset($address) ? (string) $address : null;
		CM_Db_Db::update('denkmal_venue', array('address' => $address), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string|null
	 */
	public function getLatitude() {
		$latitude = $this->_get('latitude');
		if (null === $latitude) {
			return null;
		}
		return (float) $latitude;
	}

	/**
	 * @param float|null $latitude
	 */
	public function setLatitude($latitude) {
		$latitude = isset($latitude) ? (float) $latitude : null;
		CM_Db_Db::update('denkmal_venue', array('latitude' => $latitude), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string|null
	 */
	public function getLongitude() {
		$longitude = $this->_get('longitude');
		if (null === $longitude) {
			return null;
		}
		return (float) $longitude;
	}

	/**
	 * @param float|null $longitude
	 */
	public function setLongitude($longitude) {
		$longitude = isset($longitude) ? (float) $longitude : null;
		CM_Db_Db::update('denkmal_venue', array('longitude' => $longitude), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getQueued() {
		return (boolean) $this->_get('queued');
	}

	/**
	 * @param boolean $queued
	 */
	public function setQueued($queued) {
		$queued = (boolean) $queued;
		CM_Db_Db::update('denkmal_venue', array('queued' => $queued), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getEnabled() {
		return (boolean) $this->_get('enabled');
	}

	/**
	 * @param boolean $enabled
	 */
	public function setEnabled($enabled) {
		$enabled = (boolean) $enabled;
		CM_Db_Db::update('denkmal_venue', array('enabled' => $enabled), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getHidden() {
		return (boolean) $this->_get('hidden');
	}

	/**
	 * @param boolean $hidden
	 */
	public function setHidden($hidden) {
		$hidden = (boolean) $hidden;
		CM_Db_Db::update('denkmal_venue', array('hidden' => $hidden), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return int|null
	 */
	public function getSource() {
		$source = $this->_get('source');
		if (null === $source) {
			return null;
		}
		return (int) $source;
	}

	/**
	 * @param int|null $source
	 */
	public function setSource($source) {
		$source = isset($source) ? (int) $source : null;
		CM_Db_Db::update('denkmal_venue', array('source' => $source), array('id' => $this->getId()));
		$this->_change();
	}

	protected function _loadData() {
		return CM_Db_Db::select('denkmal_venue', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected function _getContainingCacheables() {
		$cacheables = parent::_getContainingCacheables();
		$cacheables[] = new Denkmal_Paging_Venue_Public();
		return $cacheables;
	}

	protected function _onChange() {
		$paging = new Denkmal_Paging_Venue_Public();
		$paging->_change();
	}

	protected function _onDelete() {
		CM_Db_Db::delete('denkmal_venue', array('id' => $this->getId()));
	}

	protected static function _create(array $data) {
		$data = CM_Params::factory($data);

		$name = $data->getString('name');
		$url = $data->has('url') ? $data->getString('url') : null;
		$address = $data->has('address') ? $data->getString('address') : null;
		$latitude = $data->has('latitude') ? $data->getFloat('latitude') : null;
		$longitude = $data->has('longitude') ? $data->getFloat('longitude') : null;
		$queued = $data->getBoolean('queued');
		$enabled = $data->getBoolean('enabled');
		$hidden = $data->getBoolean('hidden', false);
		$source = $data->has('source') ? $data->getInt('source') : null;

		$id = CM_Db_Db::insert('denkmal_venue', array(
			'name'      => $name,
			'url'       => $url,
			'address'   => $address,
			'latitude'  => $latitude,
			'longitude' => $longitude,
			'queued'    => $queued,
			'enabled'   => $enabled,
			'hidden'    => $hidden,
			'source'    => $source,
		));

		return new static($id);
	}
}
