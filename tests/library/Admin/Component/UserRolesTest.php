<?php

class Admin_Component_UserRolesTest extends CMTest_TestCase {

    public function testAdmin() {
        $viewer = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::ADMIN);

        $user = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');
        $user->getRoles()->add(Denkmal_Role::PUBLISHER);

        $cmp = new Admin_Component_UserRoles(array('user' => $user));
        $html = $this->_renderComponent($cmp, $viewer);

        $this->assertComponentAccessible($cmp, $viewer);
        $this->assertSame(3, $html->find('.roleList-item')->count());
    }
}
