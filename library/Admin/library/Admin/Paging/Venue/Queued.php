<?php

class Admin_Paging_Venue_Queued extends Denkmal_Paging_Venue_Abstract {

	public function __construct() {
		$where = '`queued` = 1 AND `hidden` = 0';

		$source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where);
		parent::__construct($source);
	}
}
