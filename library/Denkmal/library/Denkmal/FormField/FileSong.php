<?php

class Denkmal_FormField_FileSong extends CM_FormField_File {

	public function __construct() {
		parent::__construct(1);
	}

	protected function _getAllowedExtensions() {
		return array('mp3');
	}
}
