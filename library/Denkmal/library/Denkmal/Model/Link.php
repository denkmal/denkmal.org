<?php

class Denkmal_Model_Link extends CM_Model_Abstract {

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
		CM_Db_Db::update('denkmal_link', array('automatic' => $automatic), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return bool
	 */
	public function getAutomatic() {
		return (bool) $this->_get('url');
	}

	protected function _loadData () {
		return CM_Db_Db::select('denkmal_link', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected static function _create(array $data) {
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
}
