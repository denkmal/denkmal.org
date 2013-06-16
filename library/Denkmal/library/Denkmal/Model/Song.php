<?php

class Denkmal_Model_Song extends CM_Model_Abstract {

	const TYPE = 102;

	/**
	 * @param string $label
	 */
	public function setLabel($label) {
		$label = (string) $label;
		CM_Db_Db::update('denkmal_song', array('label' => $label), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return (string) $this->_get('label');
	}

	/**
	 * @return CM_File_UserContent
	 */
	public function getFile() {
		$filename = $this->getId() . '.mp3';
		return new CM_File_UserContent('songs', $filename);
	}

	/**
	 * @param CM_Render $render
	 * @return array
	 */
	public function toArrayApi(CM_Render $render) {
		$array = array();
		$array['label'] = $this->getLabel();
		$array['url'] = $render->getUrlUserContent($this->getFile());
		return $array;
	}

	protected function _loadData () {
		return CM_Db_Db::select('denkmal_song', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected static function _create(array $data) {
		$data = CM_Params::factory($data);

		$label = $data->getString('label');
		$id = CM_Db_Db::insert('denkmal_song', array('label' => $label));
		$song = new self($id);

		$userFile = $song->getFile();
		$userFile->mkDir();
		$file = $data->getFile('file');
		$file->copy($userFile->getPath());

		return $song;
	}

	protected function _onDelete() {
		$this->getFile()->delete();
		CM_Db_Db::delete('denkmal_song', array('id' => $this->getId()));
	}
}
