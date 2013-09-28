<?php

class Admin_Paging_Event_Date extends Denkmal_Paging_Event_Abstract {

	public function __construct(DateTime $date, $queueOnly = null) {
		$date = clone $date;
		$date->setTime(6, 0, 0);
		$startStamp = $date->getTimestamp();
		$date->add(new DateInterval('P1D'));
		$endStamp = $date->getTimestamp();
		$where = '`from` >= ' . $startStamp . ' AND `from` < ' . $endStamp;

		if ($queueOnly) {
			$where .= ' AND `queued` = 1';
		} else {
			$where .= ' AND `enabled` = 1';
		}

		$source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where, '`starred`, `id`');
		parent::__construct($source);
	}
}
