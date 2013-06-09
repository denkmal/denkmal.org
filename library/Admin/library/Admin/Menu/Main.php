<?php

class Admin_Menu_Main extends CM_Menu {

	public function __construct() {
		parent::__construct(array(
			array('label' => 'Events', 'page' => 'Admin_Page_Events'),
			array('label' => 'Veranstaltungsorte', 'page' => 'Admin_Page_Venues'),
		));
	}
}
