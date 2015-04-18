<?php

class Denkmal_Push_SubscriptionTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreateWithoutUser() {
        $pushSubscription = Denkmal_Push_Subscription::create('123321foo', 'http://twitter.com/foo');

        $this->assertInstanceOf('Denkmal_Push_Subscription', $pushSubscription);
        $this->assertSame('123321foo', $pushSubscription->getSubscriptionId());
        $this->assertSame('http://twitter.com/foo', $pushSubscription->getEndpoint());
        $this->assertNull($pushSubscription->getUser());
    }

    public function testCreateWithUser() {
        $user = Denkmal_Model_User::create('foo@bar.com', 'test', 'pswd');
        $pushSubscription = Denkmal_Push_Subscription::create('123321foo', 'http://twitter.com/foo', $user);

        $this->assertInstanceOf('Denkmal_Push_Subscription', $pushSubscription);
        $this->assertSame('123321foo', $pushSubscription->getSubscriptionId());
        $this->assertSame('http://twitter.com/foo', $pushSubscription->getEndpoint());
        $this->assertEquals($user, $pushSubscription->getUser());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $pushSubscription = Denkmal_Push_Subscription::create('123321foo', 'http://twitter.com/foo');
        $pushSubscription->delete();
        new Denkmal_Push_Subscription($pushSubscription->getId());
    }
}
