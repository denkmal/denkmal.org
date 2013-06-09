<?php

class Denkmal_Paging_Event_Venue extends Denkmal_Paging_Event_Abstract {

	/**
	 * @param Denkmal_Model_Venue $venue
	 * @param bool|null           $publicOnly
	 */
	public function __construct(Denkmal_Model_Venue $venue, $publicOnly = null) {
		$now = new DateTime();
		$fromStampMin = $now->getTimestamp();

		$where = '`venueId` = ' . $venue->getId();
		$where .= ' AND `from` >= ' . $fromStampMin;
		if ($publicOnly) {
			$where .= ' AND `enabled` = 1 AND `hidden` = 0';
		}
		$source = new CM_PagingSource_Sql('id', 'denkmal_event', $where, '`starred`, `id`');
		parent::__construct($source);
	}
}
