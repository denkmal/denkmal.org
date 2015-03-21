<?php

class Denkmal_Paging_UserInvite_ExpiredTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $inviter = Denkmal_Model_User::create('foo@example.com', 'foo', '1234');

        $userInvite1 = Denkmal_Model_UserInvite::create($inviter, null, null);
        $userInvite2 = Denkmal_Model_UserInvite::create($inviter, null, new DateTime('2015-03-02'));
        $userInvite3 = Denkmal_Model_UserInvite::create($inviter, null, new DateTime('2015-03-05'));

        $this->assertEquals([], new Denkmal_Paging_UserInvite_Expired(new DateTime('2015-03-01')));
        $this->assertEquals([$userInvite2], new Denkmal_Paging_UserInvite_Expired(new DateTime('2015-03-03')));
        $this->assertEquals([$userInvite3, $userInvite2], new Denkmal_Paging_UserInvite_Expired(new DateTime('2015-03-06')));
    }
}
