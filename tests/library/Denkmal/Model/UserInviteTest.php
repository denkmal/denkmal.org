<?php

class Denkmal_Model_UserInviteTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $inviter = Denkmal_Model_User::create('foo@example.com', 'foo', '1234');
        $expires = new DateTime();
        $userInvite = Denkmal_Model_UserInvite::create($inviter, 'bar@example.com', $expires);

        $this->assertInstanceOf('Denkmal_Model_UserInvite', $userInvite);
        $this->assertEquals($inviter, $userInvite->getInviter());
        $this->assertSame('bar@example.com', $userInvite->getEmail());
        $this->assertEquals($expires, $userInvite->getExpires());
    }

    public function testCreateMinimal() {
        $inviter = Denkmal_Model_User::create('foo@example.com', 'foo', '1234');
        $userInvite = Denkmal_Model_UserInvite::create($inviter);

        $this->assertInstanceOf('Denkmal_Model_UserInvite', $userInvite);
        $this->assertEquals($inviter, $userInvite->getInviter());
        $this->assertNull($userInvite->getEmail());
        $this->assertNull($userInvite->getExpires());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $inviter = Denkmal_Model_User::create('foo@example.com', 'foo', '1234');
        $userInvite = Denkmal_Model_UserInvite::create($inviter, 'bar@example.com', new DateTime());
        $userInvite->delete();
        new Denkmal_Model_User($userInvite->getId());
    }

    public function testKey() {
        $inviter = Denkmal_Model_User::create('foo@example.com', 'foo', '1234');
        $userInvite = Denkmal_Model_UserInvite::create($inviter);

        $this->assertInternalType('string', $userInvite->getKey());
        $this->assertEquals($userInvite, Denkmal_Model_UserInvite::findByKey($userInvite->getKey()));

        $this->assertNull(Denkmal_Model_UserInvite::findByKey('123456789'));
    }
}
