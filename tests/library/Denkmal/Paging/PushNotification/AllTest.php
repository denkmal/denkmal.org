<?php

class Denkmal_Paging_PushNotification_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $pushSubscription1 = Denkmal_Model_PushSubscription::create('123321f', 'https://twitter.com/foo');
        $pushSubscription2 = Denkmal_Model_PushSubscription::create('878878f', 'https://google.com/foo');
        $this->assertEquals(array($pushSubscription1, $pushSubscription2), new Denkmal_Paging_PushNotification_All());

        $pushSubscription3 = Denkmal_Model_PushSubscription::create('123321f', 'https://twitter.com/foo');
        $this->assertEquals(array($pushSubscription1, $pushSubscription2, $pushSubscription3), new Denkmal_Paging_PushNotification_All());

        $pushSubscription3->delete();
        $this->assertEquals(array($pushSubscription1, $pushSubscription2), new Denkmal_Paging_PushNotification_All());
    }
}
