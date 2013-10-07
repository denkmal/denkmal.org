<?php

class Admin_Form_Song extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('songId', new CM_FormField_Hidden());
		$this->registerField('label', new CM_FormField_Text());
		$this->registerField('files', new Denkmal_FormField_FileSong());

		$this->registerAction(new Admin_FormAction_Song_Add($this));
		$this->registerAction(new Admin_FormAction_Song_Save($this));
		$this->registerAction(new Admin_FormAction_Song_Delete($this));
	}

	protected function _renderStart(CM_Params $params) {
		/** @var Denkmal_Params $params */
		if ($params->has('song')) {
			$song = $params->getSong('song');
			$this->getField('songId')->setValue($song->getId());
			$this->getField('label')->setValue($song->getLabel());
		}
	}
}
