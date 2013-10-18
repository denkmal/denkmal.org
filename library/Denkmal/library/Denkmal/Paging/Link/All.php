<?php

class Denkmal_Paging_Link_All extends Denkmal_Paging_Link_Abstract {

	public function __construct() {
		$source = new CM_PagingSource_Sql('id', 'denkmal_model_link', '`failedCount` < 3', 'label asc');
		$source->enableCache();
		parent::__construct($source);
	}
}
