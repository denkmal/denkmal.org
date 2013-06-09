<?php

class Denkmal_Paging_Event_DatePublic extends Denkmal_Paging_Event_Abstract {

	public function __construct() {
		$source = new CM_PagingSource_Sql('id', 'denkmal_event', '`enabled` = 1 AND `hidden` = 0', '`starred`, `id`');
		$source->enableCache();
		parent::__construct($source);
	}
}
