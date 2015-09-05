<?php

class Denkmal_Push_SubscriptionTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreateWithoutUser() {
        $pushSubscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo');

        $this->assertInstanceOf('Denkmal_Push_Subscription', $pushSubscription);
        $this->assertSame('http://twitter.com/foo/123321foo', $pushSubscription->getEndpoint());
        $this->assertInstanceOf('DateTime', $pushSubscription->getUpdated());
        $this->assertNull($pushSubscription->getUser());
    }

    public function testCreateWithUser() {
        $user = Denkmal_Model_User::create('foo@bar.com', 'test', 'pswd');
        $pushSubscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo', $user);

        $this->assertInstanceOf('Denkmal_Push_Subscription', $pushSubscription);
        $this->assertSame('http://twitter.com/foo/123321foo', $pushSubscription->getEndpoint());
        $this->assertInstanceOf('DateTime', $pushSubscription->getUpdated());
        $this->assertEquals($user, $pushSubscription->getUser());
    }

    /**
     * @expectedException CM_Db_Exception
     */
    public function testCreateDuplicate() {
        $user = Denkmal_Model_User::create('foo@bar.com', 'test', 'pswd');
        Denkmal_Push_Subscription::create('http://twitter.com/foo/foo1', $user);
        Denkmal_Push_Subscription::create('http://twitter.com/foo/foo1', $user);
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $pushSubscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo');
        $pushSubscription->delete();
        new Denkmal_Push_Subscription($pushSubscription->getId());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDeleteWithMessage() {
        $subscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo');
        $message = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), ['foo' => 12]);
        $subscription->delete();
        new Denkmal_Push_Notification_Message($message->getId());
    }
}
