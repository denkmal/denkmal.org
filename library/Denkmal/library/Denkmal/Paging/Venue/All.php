<?php

class Denkmal_Paging_Venue_All extends Denkmal_Paging_Venue_Abstract {

	public function __construct() {
		$source = new CM_PagingSource_Sql('id', 'denkmal_venue', null, '`name`');
		$source->enableCache();
		parent::__construct($source);
	}
}
