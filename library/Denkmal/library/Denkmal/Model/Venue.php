<?php

class Denkmal_Model_Venue extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

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
	 * @return CM_Geo_Point|null
	 */
	public function getCoordinates() {
		$latitude = $this->_get('latitude');
		$longitude = $this->_get('longitude');
		if (null === $latitude || null === $longitude) {
			return null;
		}
		return new CM_Geo_Point($latitude, $longitude);
	}

	/**
	 * @param CM_Geo_Point|null $coordinates
	 */
	public function setCoordinates(CM_Geo_Point $coordinates = null) {
		$latitude = $coordinates ? $coordinates->getLatitude() : null;
		$longitude = $coordinates ? $coordinates->getLongitude() : null;

		CM_Db_Db::update('denkmal_venue', array('latitude' => $latitude, 'longitude' => $longitude), array('id' => $this->getId()));
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

	public function toArrayApi(CM_Render $render) {
		$array = array();
		$array['id'] = $this->getId();
		$array['name'] = $this->getName();
		if ($url = $this->getUrl()) {
			$array['url'] = $url;
		}
		if ($address = $this->getAddress()) {
			$array['address'] = $address;
		}
		if ($coordinates = $this->getCoordinates()) {
			$array['latitude'] = $coordinates->getLatitude();
			$array['longitude'] = $coordinates->getLongitude();
		}
		return $array;
	}

	protected function _loadData() {
		return CM_Db_Db::select('denkmal_venue', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected function _getContainingCacheables() {
		$cacheables = parent::_getContainingCacheables();
		$cacheables[] = new Denkmal_Paging_Venue_All();
		return $cacheables;
	}

	protected function _onDelete() {
		CM_Db_Db::delete('denkmal_venue', array('id' => $this->getId()));
	}

	/**
	 * @param string $name
	 * @return Denkmal_Model_Venue|null
	 */
	public static function findByName($name) {
		$name = (string) $name;
		$venueId = CM_Db_Db::select('denkmal_venue', 'id', array('name' => $name))->fetchColumn();
		if (!$venueId) {
			return null;
		}
		return new self($venueId);
	}

	/**
	 * @param string $name
	 * @return Denkmal_Model_Venue|null
	 */
	public static function findByNameOrAlias($name) {
		if ($venue = self::findByName($name)) {
			return $venue;
		}
		if ($venueAlias = Denkmal_Model_VenueAlias::findByName($name)) {
			return $venueAlias->getVenue();
		}
		return null;
	}

	protected static function _createStatic(array $data) {
		$data = CM_Params::factory($data);

		$name = $data->getString('name');
		$url = $data->has('url') ? $data->getString('url') : null;
		$address = $data->has('address') ? $data->getString('address') : null;
		$coordinates = $data->has('coordinates') ? $data->getGeoPoint('coordinates') : null;
		$queued = $data->getBoolean('queued');
		$enabled = $data->getBoolean('enabled');
		$hidden = $data->getBoolean('hidden', false);

		$id = CM_Db_Db::insert('denkmal_venue', array(
			'name'      => $name,
			'url'       => $url,
			'address'   => $address,
			'latitude'  => ($coordinates ? $coordinates->getLatitude() : null),
			'longitude' => ($coordinates ? $coordinates->getLongitude() : null),
			'queued'    => $queued,
			'enabled'   => $enabled,
			'hidden'    => $hidden,
		));

		return new static($id);
	}
}
