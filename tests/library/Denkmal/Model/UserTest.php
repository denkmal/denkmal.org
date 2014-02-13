<?php

class Denkmal_Model_UserTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearDb();
	}

	public function testCreate() {
		$user = Denkmal_Model_User::create('foo@bar', 'foo');
		$this->assertRow('denkmal_model_user', null, 1);
		$this->assertSame('foo@bar', $user->getEmail());
	}

	public function testAuthenticate() {
		$user = Denkmal_Model_User::create('foo@bar', 'foo');
		$authenticatedUser = Denkmal_Model_User::authenticate('foo@bar', 'foo');
		$this->assertEquals($user, $authenticatedUser);
	}

	/**
	 * @expectedException CM_Exception_AuthFailed
	 */
	public function testAuthenticateIncorrectLogin() {
		Denkmal_Model_User::create('foo@bar', 'foo');
		Denkmal_Model_User::authenticate('foo@bar', 'bar');
	}
}
