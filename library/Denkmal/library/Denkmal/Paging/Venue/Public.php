<?php

class Denkmal_Paging_Venue_Public extends Denkmal_Paging_Venue_Abstract {

	public function __construct() {
		$source = new CM_PagingSource_Sql('id', 'denkmal_venue', 'enabled = 1 AND hidden = 0', '`name`');
		$source->enableCache();
		parent::__construct($source);
	}
}
