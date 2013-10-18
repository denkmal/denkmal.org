<?php

class Denkmal_Model_Link extends CM_Model_Abstract {

	const TYPE = 105;

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->_get('label');
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label) {
		$this->_set('label', $label);
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->_get('url');
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->_set('url', $url);
	}

	/**
	 * @return boolean
	 */
	public function getAutomatic() {
		return $this->_get('automatic');
	}

	/**
	 * @param boolean $automatic
	 */
	public function setAutomatic($automatic) {
		$this->_set('automatic', $automatic);
	}

	protected function _getSchema() {
		return new CM_Model_Schema_Definition(array(
			'label'     => array('type' => 'string'),
			'url'       => array('type' => 'string'),
			'automatic' => array('type' => 'bool'),
		));
	}

	protected function _getContainingCacheables() {
		$containingCacheables = parent::_getContainingCacheables();
		$containingCacheables[] = new Denkmal_Paging_Link_All();
		return $containingCacheables;
	}

	public static function deleteEventtextCaches() {
		CM_Cache_Local::getInstance()->flush();
	}

	/**
	 * @param string    $label
	 * @param string    $url
	 * @param bool|null $automatic
	 * @return Denkmal_Model_Link
	 */
	public static function create($label, $url, $automatic = null) {
		$link = new self();
		$link->setLabel($label);
		$link->setUrl($url);
		$link->setAutomatic($automatic);
		$link->commit();
		return $link;
	}

	public static function getPersistenceClass() {
		return 'CM_Model_StorageAdapter_Database';
	}
}
