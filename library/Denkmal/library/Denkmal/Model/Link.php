<?php

class Denkmal_Model_Link extends CM_Model_Abstract {

	const TYPE = 105;

	/**
	 * @return string
	 */
	public function getLabel() {
		return (string) $this->_get('label');
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return (string) $this->_get('url');
	}

	/**
	 * @param boolean $automatic
	 */
	public function setAutomatic($automatic) {
		$automatic = (bool) $automatic;
		CM_Db_Db::update('denkmal_link', array('automatic' => $automatic), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return bool
	 */
	public function getAutomatic() {
		return (bool) $this->_get('automatic');
	}

	protected function _loadData () {
		return CM_Db_Db::select('denkmal_link', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected static function _createStatic(array $data) {
		$data = Denkmal_Params::factory($data);
		$label = $data->getString('label');
		$url = $data->getString('url');
		$automatic = $data->getBoolean('automatic', false);

		$id = CM_Db_Db::insert('denkmal_link', array(
			'label'      => $label,
			'url'       => $url,
			'automatic'   => $automatic,
		));

		return new static($id);
	}

	protected function _onDelete() {
		CM_Db_Db::delete('denkmal_link', array('id' => $this->getId()));
	}

	protected function _getContainingCacheables() {
		$containingCacheables = parent::_getContainingCacheables();
		$containingCacheables[] = new Denkmal_Paging_Link_All();
		return $containingCacheables;
	}
}
