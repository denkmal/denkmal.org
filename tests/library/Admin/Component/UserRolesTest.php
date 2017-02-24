<?php

class Admin_Component_UserRolesTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testAdmin() {
        $viewer = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::ADMIN);

        $user = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');
        $user->getRoles()->add(Denkmal_Role::PUBLISHER);

        $cmp = new Admin_Component_UserRoles(array('user' => $user));
        $html = $this->_renderComponent($cmp, $viewer);

        $this->assertComponentAccessible($cmp, $viewer);
        $this->assertSame(2, $html->find('.roleList-item')->count());
    }

    public function testAjax_setRole() {
        $viewer = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::ADMIN);

        $user = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');

        $environment = new CM_Frontend_Environment(null, $viewer);
        $response = $this->getResponseAjax(new Admin_Component_UserRoles(['user' => $user]),
            'setRole', ['role' => Denkmal_Role::PUBLISHER, 'state' => true], $environment);
        $this->assertViewResponseSuccess($response);
        CMTest_TH::reinstantiateModel($user);
        $this->assertSame(true, $user->getRoles()->contains(Denkmal_Role::PUBLISHER));

        $response = $this->getResponseAjax(new Admin_Component_UserRoles(['user' => $user]),
            'setRole', ['role' => Denkmal_Role::PUBLISHER, 'state' => false], $environment);
        $this->assertViewResponseSuccess($response);
        CMTest_TH::reinstantiateModel($user);
        $this->assertSame(false, $user->getRoles()->contains(Denkmal_Role::PUBLISHER));
    }

    public function testAjax_setRoleOnlyForAdmin() {
        $viewer = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::PUBLISHER);

        $user = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');

        $environment = new CM_Frontend_Environment(null, $viewer);
        $response = $this->getResponseAjax(new Admin_Component_UserRoles(['user' => $user]),
            'setRole', ['role' => Denkmal_Role::PUBLISHER, 'state' => true], $environment);
        $this->assertViewResponseError($response);
    }
}
