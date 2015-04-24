<?php

class Denkmal_Push_Notification_MessageMemoList_SubscriptionTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $subscription = Denkmal_Push_Subscription::create('foo1', 'https://twitter.com/foo');
        $messageMemo1 = Denkmal_Push_Notification_MessageMemo::create($subscription, new DateTime('2015-01-01'), []);
        $messageMemo2 = Denkmal_Push_Notification_MessageMemo::create($subscription, new DateTime('2015-01-01'), []);
        $this->assertEquals([$messageMemo2, $messageMemo1],
            new Denkmal_Push_Notification_MessageMemoList_Subscription($subscription));

        $messageMemo3 = Denkmal_Push_Notification_MessageMemo::create($subscription, new DateTime('2015-01-01'), []);
        $this->assertEquals([$messageMemo3, $messageMemo2, $messageMemo1],
            new Denkmal_Push_Notification_MessageMemoList_Subscription($subscription));

        $messageMemo2->delete();
        $this->assertEquals([$messageMemo3, $messageMemo1],
            new Denkmal_Push_Notification_MessageMemoList_Subscription($subscription));
    }
}
