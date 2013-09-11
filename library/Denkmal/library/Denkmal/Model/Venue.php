<?php

class Denkmal_Model_Venue extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

	const TYPE = 100;

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
	 * @return string|null
	 */
	public function getUrl() {
		return $this->_get('url');
	}

	/**
	 * @param string|null $url
	 */
	public function setUrl($url) {
		$this->_set('url', $url);
	}

	/**
	 * @return string|null
	 */
	public function getAddress() {
		return $this->_get('address');
	}

	/**
	 * @param string|null $address
	 */
	public function setAddress($address) {
		$this->_set('address', $address);
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
		$this->_set('latitude', $latitude);
		$this->_set('longitude', $longitude);
	}

	/**
	 * @return boolean
	 */
	public function getQueued() {
		return $this->_get('queued');
	}

	/**
	 * @param boolean $queued
	 */
	public function setQueued($queued) {
		$this->_set('queued', $queued);
	}

	/**
	 * @return boolean
	 */
	public function getEnabled() {
		return $this->_get('enabled');
	}

	/**
	 * @param boolean $enabled
	 */
	public function setEnabled($enabled) {
		$this->_set('enabled', $enabled);
	}

	/**
	 * @return boolean
	 */
	public function getHidden() {
		return $this->_get('hidden');
	}

	/**
	 * @param boolean $hidden
	 */
	public function setHidden($hidden) {
		$this->_set('hidden', $hidden);
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

	protected function _getContainingCacheables() {
		$cacheables = parent::_getContainingCacheables();
		$cacheables[] = new Denkmal_Paging_Venue_All();
		return $cacheables;
	}

	/**
	 * @param string $name
	 * @return Denkmal_Model_Venue|null
	 */
	public static function findByName($name) {
		$name = (string) $name;
		$venueId = CM_Db_Db::select('denkmal_model_venue', 'id', array('name' => $name))->fetchColumn();
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

	/**
	 * @param string            $name
	 * @param boolean           $queued
	 * @param boolean           $enabled
	 * @param boolean           $hidden
	 * @param string|null       $url
	 * @param string|null       $address
	 * @param CM_Geo_Point|null $coordinates
	 * @return Denkmal_Model_Venue
	 */
	public static function create($name, $queued, $enabled, $hidden, $url = null, $address = null, CM_Geo_Point $coordinates = null) {
		$venue = new self();
		$venue->setName($name);
		$venue->setUrl($url);
		$venue->setAddress($address);
		$venue->setCoordinates($coordinates);
		$venue->setQueued($queued);
		$venue->setEnabled($enabled);
		$venue->setHidden($hidden);
		$venue->commit();
		return $venue;
	}

	protected function _getSchema() {
		return new CM_Model_Schema_Definition(array(
			'name'      => array('type' => 'string'),
			'url'       => array('type' => 'string', 'optional' => true),
			'address'   => array('type' => 'string', 'optional' => true),
			'latitude'  => array('type' => 'float', 'optional' => true),
			'longitude' => array('type' => 'float', 'optional' => true),
			'queued'    => array('type' => 'boolean'),
			'enabled'   => array('type' => 'boolean'),
			'hidden'    => array('type' => 'boolean'),
		));
	}

	public static function getPersistenceClass() {
		return 'CM_Model_StorageAdapter_Database';
	}
}
