<?php

class Denkmal_Paging_Event_VenueDate extends Denkmal_Paging_Event_Abstract {

	/**
	 * @param Denkmal_Model_Venue        $venue
	 * @param DateTime                   $fromDate
	 * @param DateTime                   $untilDate
	 * @param Denkmal_Model_Event[]|null $without
	 * @param bool|null                  $showAll
	 */
	public function __construct(Denkmal_Model_Venue $venue, DateTime $fromDate = null, DateTime $untilDate = null, $without = null, $showAll = null) {
		$where = '`venue` = ' . $venue->getId();

		$order = '`from`';

		if ($fromDate) {
			$where .= ' AND `from` >= ' . $fromDate->getTimestamp();
		}

		if ($untilDate) {
			$where .= ' AND `from` <= ' . $untilDate->getTimestamp();
			if (!$fromDate) {
				$order = '`from` DESC';
			}
		}

		if ($without) {
			foreach($without as $event){
				$where .= ' AND `id` != ' . $event->getId();
			}
		}

		if (!$showAll) {
			$where .= ' AND `enabled` = 1 AND `hidden` = 0';
		}

		$source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where, $order);
		parent::__construct($source);
	}
}
