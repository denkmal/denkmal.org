<?php

class Denkmal_Paging_UserInvite_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $inviter = Denkmal_Model_User::create('foo@example.com', 'foo', '1234');

        $userInvite1 = Denkmal_Model_UserInvite::create($inviter);
        $userInvite2 = Denkmal_Model_UserInvite::create($inviter);

        $this->assertEquals(array($userInvite2, $userInvite1), new Denkmal_Paging_UserInvite_All());

        $userInvite3 = Denkmal_Model_UserInvite::create($inviter);
        $userInvite2->delete();
        $this->assertEquals(array($userInvite3, $userInvite1), new Denkmal_Paging_UserInvite_All());
    }
}
