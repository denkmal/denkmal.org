<?php

class Admin_Paging_Venue_Queued extends Denkmal_Paging_Venue_Abstract {

	public function __construct() {
		$where = '`queued` = 1';

		$source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where, '`name`');
		parent::__construct($source);
	}
}
