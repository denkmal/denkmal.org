<?php

class Denkmal_Model_Song extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

	const TYPE = 102;

	/**
	 * @param string $label
	 */
	public function setLabel($label) {
		$this->_set('label', $label);
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->_get('label');
	}

	/**
	 * @return CM_File_UserContent
	 */
	public function getFile() {
		$filename = $this->getId() . '.mp3';
		return new CM_File_UserContent('songs', $filename);
	}

	public function toArray() {
		$array = parent::toArray();
		$array['path'] = $this->getFile()->getPathRelative();
		return $array;
	}

	public function toArrayApi(CM_Render $render) {
		$array = array();
		$array['label'] = $this->getLabel();
		$array['url'] = $render->getUrlUserContent($this->getFile());
		return $array;
	}

	protected function _getSchema() {
		return new CM_Model_Schema_Definition(array(
			'label' => array('type' => 'string'),
		));
	}

	protected function _onDelete() {
		$this->getFile()->delete();
	}

	/**
	 * @param string  $label
	 * @param CM_File $file
	 * @return Denkmal_Model_Song
	 */
	public static function create($label, CM_File $file) {
		$song = new self();
		$song->setLabel($label);
		$song->commit();

		$userFile = $song->getFile();
		$userFile->mkDir();
		$file->copy($userFile->getPath());

		return $song;
	}

	public static function getPersistenceClass() {
		return 'CM_Model_StorageAdapter_Database';
	}
}
