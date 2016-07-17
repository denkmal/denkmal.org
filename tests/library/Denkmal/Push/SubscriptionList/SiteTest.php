<?php

class Denkmal_Push_SubscriptionList_SiteTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $site1 = $this->getMockSite();
        $site2 = $this->getMockSite();

        $pushSubscription1 = Denkmal_Push_Subscription::create('https://twitter.com/foo/foo1', $site1);
        $pushSubscription2 = Denkmal_Push_Subscription::create('https://google.com/foo/foo2', $site1);
        $pushSubscriptionOther = Denkmal_Push_Subscription::create('https://google.com/foo/fooOther', $site2);
        $this->assertEquals(array($pushSubscription1, $pushSubscription2), new Denkmal_Push_SubscriptionList_Site($site1));

        $pushSubscription3 = Denkmal_Push_Subscription::create('https://twitter.com/foo/foo3', $site1);
        $this->assertEquals(array($pushSubscription1, $pushSubscription2, $pushSubscription3), new Denkmal_Push_SubscriptionList_Site($site1));

        $pushSubscription3->delete();
        $this->assertEquals(array($pushSubscription1, $pushSubscription2), new Denkmal_Push_SubscriptionList_Site($site1));
    }
}
