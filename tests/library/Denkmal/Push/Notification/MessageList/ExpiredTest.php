<?php

class Denkmal_Push_Notification_MessageList_ExpiredTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $nowOriginal = new DateTime();
        $now = function () use ($nowOriginal) {
            return clone $nowOriginal;
        };

        $site = $this->getMockSite();
        $subscription = Denkmal_Push_Subscription::create('https://twitter.com/foo/foo1', $site);
        $message1 = Denkmal_Push_Notification_Message::create($subscription, $now()->add(new DateInterval('PT30S')), []);
        $message2 = Denkmal_Push_Notification_Message::create($subscription, $now()->add(new DateInterval('PT20S')), []);
        $message3 = Denkmal_Push_Notification_Message::create($subscription, $now()->add(new DateInterval('PT10S')), []);

        $this->assertEquals([],
            new Denkmal_Push_Notification_MessageList_Expired($now()));

        $this->assertEquals([],
            new Denkmal_Push_Notification_MessageList_Expired());

        $this->assertEquals([$message3, $message2],
            new Denkmal_Push_Notification_MessageList_Expired($now()->add(new DateInterval('PT22S'))));

        $this->assertEquals([$message3, $message2, $message1],
            new Denkmal_Push_Notification_MessageList_Expired($now()->add(new DateInterval('PT100S'))));
    }
}
