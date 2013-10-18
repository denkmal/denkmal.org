<?php

class Admin_Menu_Weekdays extends CM_Menu {

	public function __construct() {
		$data = array();
		/** @var DateTime $date */
		foreach (new Denkmal_Paging_DateTime_Days(10) as $date) {
			$data[] = array(
				'label'  => $date,
				'page'   => 'Admin_Page_Events',
				'params' => array('date' => $date->format('Y-n-j')),
			);
		}

		parent::__construct($data);
	}
}
