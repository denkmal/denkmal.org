<?php

class Denkmal_App_Cli extends CM_App_Cli {

	public function fillExampleData() {
		$admin = Denkmal_Model_User::create(array('email' => 'admin@denkmal.org', 'password' => 'admin'));
		$admin->getRoles()->add(Denkmal_Role::ADMIN);
	}

}
