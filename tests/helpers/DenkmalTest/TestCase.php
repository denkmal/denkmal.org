<?php

abstract class DenkmalTest_TestCase extends CMTest_TestCase {

    /**
     * @param int|null $role
     * @return Denkmal_Model_User
     */
    protected function _createViewer($role = null) {
        $viewer = DenkmalTest_TH::createUser();
        if (!is_null($role)) {
            $viewer->getRoles()->add($role);
        }
        return $viewer;
    }
}
