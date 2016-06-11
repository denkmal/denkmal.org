<?php

class Denkmal_Push_Notification_MessageList_SubscriptionTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $site = $this->getMockSite();
        $subscription = Denkmal_Push_Subscription::create('https://twitter.com/foo/foo1', $site);
        $message1 = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), []);
        $message2 = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), []);
        $this->assertEquals([$message2, $message1],
            new Denkmal_Push_Notification_MessageList_Subscription($subscription));

        $message3 = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), []);
        $this->assertEquals([$message3, $message2, $message1],
            new Denkmal_Push_Notification_MessageList_Subscription($subscription));

        $message2->delete();
        $this->assertEquals([$message3, $message1],
            new Denkmal_Push_Notification_MessageList_Subscription($subscription));
    }
}
