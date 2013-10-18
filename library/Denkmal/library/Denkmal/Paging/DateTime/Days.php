<?php

class Denkmal_Paging_DateTime_Days extends Denkmal_Paging_DateTime_Abstract {

	/**
	 * @param int|null $daysCount
	 */
	public function __construct($daysCount = null) {
		$days = 7;
		if (null !== $daysCount) {
			$days = (int) $daysCount;
		}
		$day = new DateInterval('P1D');
		$date = Denkmal_Site::getCurrentDate();
		$dateList = array();
		for ($i = 0; $i < $days; $i++) {
			$dateList[] = clone $date;
			$date->add($day);
		}

		$source = new CM_PagingSource_Array($dateList);
		parent::__construct($source);
	}
}
