<?php

class Admin_Menu_Main extends CM_Menu {

	public function __construct() {
		parent::__construct(array(
			array('label' => 'Home', 'page' => 'Admin_Page_Index'),
			array('label' => 'Veranstaltungsorte', 'page' => 'Admin_Page_Venues'),
			array('label' => 'Links', 'page' => 'Admin_Page_Links'),
		));
	}
}
