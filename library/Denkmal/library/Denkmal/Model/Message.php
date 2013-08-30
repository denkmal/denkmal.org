<?php

class Denkmal_Model_Message extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

	const TYPE = 104;

	/**
	 * @return string
	 */
	public function getText() {
		return (string) $this->_get('text');
	}

	/**
	 * @return Denkmal_Model_Venue
	 */
	public function getVenue() {
		return new Denkmal_Model_Venue($this->_get('venueId'));
	}

	/**
	 * @return int
	 */
	public function getCreated() {
		return (int) $this->_get('created');
	}

	public function toArrayApi(CM_Render $render) {
		$array = array();
		$array['id'] = $this->getId();
		$array['venue'] = $this->getVenue()->getId();
		$array['created'] = $this->getCreated();
		$array['text'] = $this->getText();
		return $array;
	}

	protected function _loadData() {
		return CM_Db_Db::select('denkmal_message', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected function _getContainingCacheables() {
		$containingCacheables = parent::_getContainingCacheables();
		$containingCacheables[] = new Denkmal_Paging_Message_All();
		return $containingCacheables;
	}

	protected static function _createStatic(array $data) {
		$data = Denkmal_Params::factory($data);

		$venue = $data->getVenue('venue');
		$text = $data->getString('text');
		$created = time();

		$id = CM_Db_Db::insert('denkmal_message', array('venueId' => $venue->getId(), 'text' => $text, 'created' => $created));
		return new self($id);
	}

	protected function _onDelete() {
		CM_Db_Db::delete('denkmal_message', array('id' => $this->getId()));
	}
}
