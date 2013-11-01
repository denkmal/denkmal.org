<?php

class Admin_Menu_Main extends CM_Menu {

	public function __construct() {
		parent::__construct(array(
			array('label' => 'Veranstaltungen', 'page' => 'Admin_Page_Events'),
			array('label' => 'Orte', 'page' => 'Admin_Page_Venues'),
			array('label' => 'Links', 'page' => 'Admin_Page_Links'),
			array('label' => 'Lieder', 'page' => 'Admin_Page_Songs'),
		));
	}
}
