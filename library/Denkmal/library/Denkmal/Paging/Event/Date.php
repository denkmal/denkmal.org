<?php

class Denkmal_Paging_Event_Date extends Denkmal_Paging_Event_Abstract {

	public function __construct(DateTime $date, $publicOnly = null) {
		$date->setTime(6, 0, 0);
		$startStamp = $date->getTimestamp();
		$date->add(new DateInterval('P1D'));
		$endStamp = $date->getTimestamp();
		$where = '`from` >= ' . $startStamp . ' AND `from` < ' . $endStamp;

		if ($publicOnly) {
			$where .= ' AND `enabled` = 1 AND `hidden` = 0';
		}

		$source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where, '`starred`, `id`');
		parent::__construct($source);
	}
}
