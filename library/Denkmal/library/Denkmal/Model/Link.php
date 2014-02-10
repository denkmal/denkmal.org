<?php

class Denkmal_Model_Link extends CM_Model_Abstract {

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

	/**
	 * @return int
	 */
	public function getFailedCount() {
		return $this->_get('failedCount');
	}

	/**
	 * @param int $failedCount
	 */
	public function setFailedCount($failedCount) {
		$this->_set('failedCount', $failedCount);
		$linkList = new Denkmal_Paging_Link_All();
		$linkList->_change();
		$linkListBroken = new Denkmal_Paging_Link_Broken();
		$linkListBroken->_change();
	}

	protected function _getSchema() {
		return new CM_Model_Schema_Definition(array(
			'label'       => array('type' => 'string'),
			'url'         => array('type' => 'string'),
			'automatic'   => array('type' => 'bool'),
			'failedCount' => array('type' => 'int'),
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
	 * @param string $label
	 * @return Denkmal_Model_Link|null
	 */
	public static function findByLabel($label) {
		$label = (string) $label;
		$linkId = CM_Db_Db::select('denkmal_model_link', 'id', array('label' => $label))->fetchColumn();
		if (!$linkId) {
			return null;
		}
		return new self($linkId);
	}

	/**
	 * @param string    $label
	 * @param string    $url
	 * @param bool|null $automatic
	 * @param int|null  $failedCount
	 * @return Denkmal_Model_Link
	 */
	public static function create($label, $url, $automatic = null, $failedCount = null) {
		if (null === $failedCount) {
			$failedCount = 0;
		}
		$link = new self();
		$link->setLabel($label);
		$link->setUrl($url);
		$link->setAutomatic($automatic);
		$link->setFailedCount($failedCount);
		$link->commit();
		return $link;
	}

	public static function getPersistenceClass() {
		return 'CM_Model_StorageAdapter_Database';
	}
}
