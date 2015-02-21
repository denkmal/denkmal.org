<?php

class Denkmal_ExampleData_Users extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        $admin = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'admin');
        $admin->getRoles()->add(Denkmal_Role::ADMIN);

        $this->_setLoaded(true);
    }
}
