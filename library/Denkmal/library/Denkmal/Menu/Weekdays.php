<?php

class Denkmal_Menu_Weekdays extends CM_Menu {

	public function __construct() {
		$data = array();
		/** @var DateTime $date */
		foreach (new Denkmal_Paging_DateTime_Days() as $date) {
			$data[] = array(
				'label'  => $date,
				'page'   => 'Denkmal_Page_Events',
				'params' => array('date' => $date->format('Y-n-j')),
			);
		}

		parent::__construct($data);
	}
}
