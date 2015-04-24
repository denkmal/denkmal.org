<?php

class Denkmal_Push_Notification_MessageMemoTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $subscription = Denkmal_Push_Subscription::create('foo1', 'http://example.com');
        $expires = new DateTime('2015-01-01');
        $data = ['foo' => 12, 'bar' => 13];
        $messageMemo = Denkmal_Push_Notification_MessageMemo::create($subscription, $expires, $data);

        $this->assertInstanceOf('Denkmal_Push_Notification_MessageMemo', $messageMemo);
        $this->assertEquals($subscription, $messageMemo->getSubscription());
        $this->assertEquals($expires, $messageMemo->getExpires());
        $this->assertEquals($data, $messageMemo->getData());
    }

}
