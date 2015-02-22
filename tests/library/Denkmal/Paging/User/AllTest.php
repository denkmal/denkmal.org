<?php

class Denkmal_Paging_User_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $user1 = Denkmal_Model_User::create('foo@example.com', 'foo', 'pass');
        $user2 = Denkmal_Model_User::create('bar@example.com', 'bar', 'pass');

        $this->assertEquals(array($user2, $user1), new Denkmal_Paging_User_All());

        $user3 = Denkmal_Model_User::create('zoo@example.com', 'zoo', 'pass');
        $this->assertEquals(array($user2, $user1, $user3), new Denkmal_Paging_User_All());

        $user2->delete();
        $this->assertEquals(array($user1, $user3), new Denkmal_Paging_User_All());
    }
}
