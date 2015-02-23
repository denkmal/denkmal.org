<?php

abstract class DenkmalTest_TestCase extends CMTest_TestCase {

    /**
     * @param CM_Http_Request_Abstract|\Mocka\ClassTrait $request
     * @param Denkmal_Model_User                         $user
     * @return CM_Http_Response_Abstract|\Mocka\ClassTrait
     */
    public function processRequestWithViewer(CM_Http_Request_Abstract $request, Denkmal_Model_User $user) {
        $request->mockMethod('getViewer')->set($user);
        return $this->processRequest($request);
    }

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
