<?php

class Denkmal_Model_UserTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $user = Denkmal_Model_User::create('foo@bar', 'foo', 'pass');
        $this->assertRow('denkmal_model_user', null, 1);
        $this->assertSame('foo@bar', $user->getEmail());
        $this->assertSame('foo', $user->getUsername());
    }

    /**
     * @expectedException CM_Db_Exception
     */
    public function testCreateDuplicateUsername() {
        Denkmal_Model_User::create('foo@example.com', 'foo', 'pass');
        Denkmal_Model_User::create('bar@example.com', 'foo', 'pass');
    }

    public function testGetSetUsername() {
        $user = Denkmal_Model_User::create('foo@bar', 'foo', 'pass');

        $user->setUsername('bar');
        $this->assertSame('bar', $user->getUsername());
    }

    public function testAuthenticate() {
        $user = Denkmal_Model_User::create('foo@bar', 'foo', 'pass');
        $authenticatedUser = Denkmal_Model_User::authenticate('foo@bar', 'pass');
        $this->assertEquals($user, $authenticatedUser);
    }

    /**
     * @expectedException CM_Exception_AuthFailed
     */
    public function testAuthenticateIncorrectLogin() {
        Denkmal_Model_User::create('foo@bar', 'foo', 'pass');
        Denkmal_Model_User::authenticate('foo@bar', 'bar');
    }
}
