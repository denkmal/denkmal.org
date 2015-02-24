<?php

class Denkmal_Component_ChangePasswordTest extends CMTest_TestCase {

    public function testGuest() {
        $cmp = new Denkmal_Component_ChangePassword();

        $this->assertComponentNotAccessible($cmp);
    }

    public function testHipster() {
        $viewer = Denkmal_Model_User::create('foo@bar', 'foo', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::HIPSTER);
        $cmp = new Denkmal_Component_ChangePassword(null);
        $page = $this->_renderComponent($cmp, $viewer);

        $this->assertComponentAccessible($cmp, $viewer);
        $this->assertTrue($page->has('[name="old_password"]'));
        $this->assertTrue($page->has('[name="new_password"]'));
        $this->assertTrue($page->has('[name="new_password_confirm"]'));
    }
}
