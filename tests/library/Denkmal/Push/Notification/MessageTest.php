<?php

class Denkmal_Push_Notification_MessageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $site = $this->getMockSite();
        $subscription = Denkmal_Push_Subscription::create('http://example.com/foo1', $site);
        $expires = new DateTime('2015-01-01');
        $data = ['foo' => 12, 'bar' => 13];
        $message = Denkmal_Push_Notification_Message::create($subscription, $expires, $data);

        $this->assertInstanceOf('Denkmal_Push_Notification_Message', $message);
        $this->assertEquals($subscription, $message->getSubscription());
        $this->assertEquals($expires, $message->getExpires());
        $this->assertEquals($data, $message->getData());
    }

    public function testRpcGetListBySubscription() {
        $site = $this->getMockSite();
        $subscription = Denkmal_Push_Subscription::create('http://example.com/foo1', $site);
        $message1 = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), ['foo' => 12]);
        $message2 = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), ['foo' => 13]);

        $result = Denkmal_Push_Notification_Message::rpc_getListBySubscription('http://example.com/foo1');
        $this->assertEquals([$message2->getData(), $message1->getData()], $result);

        $result = Denkmal_Push_Notification_Message::rpc_getListBySubscription('http://example.com/foo1');
        $this->assertEquals([], $result);
    }

    /**
     * @expectedException CM_Exception_Invalid
     */
    public function testRpcGetListBySubscriptionInvalidParams() {
        $site = $this->getMockSite();
        Denkmal_Push_Subscription::create('http://example.com/foo1', $site);

        Denkmal_Push_Notification_Message::rpc_getListBySubscription('http://example.com/foo2');
    }
}
