<?php

class Admin_Page_EventsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testPublisher() {
        $viewer = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::PUBLISHER);

        $page = new Admin_Page_Events(['date' => (new DateTime())->format('Y-n-j')]);
        $html = $this->_renderPage($page, $viewer, new Admin_Site());
        $this->assertComponentAccessible($page, $viewer);
    }

    public function testAdmin() {
        $viewer = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::ADMIN);

        $page = new Admin_Page_Events(['date' => (new DateTime())->format('Y-n-j')]);
        $html = $this->_renderPage($page, $viewer, new Admin_Site());
        $this->assertComponentAccessible($page, $viewer);
    }

    public function testHipster() {
        $viewer = Denkmal_Model_User::create('foo@denkmal.org', 'foo', 'pass');
        $viewer->getRoles()->add(Denkmal_Role::HIPSTER);

        $page = new Admin_Page_Events(['date' => (new DateTime())->format('Y-n-j')]);
        $this->assertPageNotRenderable($page, 'CM_Exception_AuthRequired', $viewer);
    }
}
