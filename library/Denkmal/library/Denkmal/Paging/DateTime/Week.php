<?php

class Denkmal_Paging_DateTime_Week extends Denkmal_Paging_DateTime_Abstract {

	public function __construct() {
		$day = new DateInterval('P1D');
		$date = Denkmal_Site::getCurrentDate();
		$dateList = array();
		for ($i = 0; $i < 7; $i++) {
			$dateList[] = clone $date;
			$date->add($day);
		}

		$source = new CM_PagingSource_Array($dateList);
		parent::__construct($source);
	}
}
