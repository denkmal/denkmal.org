<?php

class Denkmal_Push_Notification_MessageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $subscription = Denkmal_Push_Subscription::create('foo1', 'http://example.com');
        $expires = new DateTime('2015-01-01');
        $data = ['foo' => 12, 'bar' => 13];
        $message = Denkmal_Push_Notification_Message::create($subscription, $expires, $data);

        $this->assertInstanceOf('Denkmal_Push_Notification_Message', $message);
        $this->assertEquals($subscription, $message->getSubscription());
        $this->assertEquals($expires, $message->getExpires());
        $this->assertEquals($data, $message->getData());
    }

}
