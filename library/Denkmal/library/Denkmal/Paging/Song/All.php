<?php

class Denkmal_Paging_Song_All extends Denkmal_Paging_Song_Abstract {

	public function __construct() {
		$source = new CM_PagingSource_Sql('id', 'denkmal_model_song', null, '`label`');
		parent::__construct($source);
	}
}
