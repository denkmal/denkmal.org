<?php

class Denkmal_Paging_DateTime_Week extends Denkmal_Paging_DateTime_Abstract {

	public function __construct() {
		$day = new DateInterval('P1D');
		$dateList = array();
		$date = new DateTime();
		$date->setTime(0, 0, 0);
		for ($i = 0; $i < 7; $i++) {
			$dateList[] = clone $date;
			$date->add($day);
		}

		$source = new CM_PagingSource_Array($dateList);
		parent::__construct($source);
	}
}
