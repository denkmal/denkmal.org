<?php

class Denkmal_Push_SubscriptionTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreateWithoutUser() {
        $site = $this->getMockSite();
        $pushSubscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo', $site);

        $this->assertInstanceOf('Denkmal_Push_Subscription', $pushSubscription);
        $this->assertSame('http://twitter.com/foo/123321foo', $pushSubscription->getEndpoint());
        $this->assertEquals($site, $pushSubscription->getSite());
        $this->assertInstanceOf('DateTime', $pushSubscription->getUpdated());
        $this->assertNull($pushSubscription->getUser());
    }

    public function testCreateWithUser() {
        $site = $this->getMockSite();
        $user = Denkmal_Model_User::create('foo@bar.com', 'test', 'pswd');
        $pushSubscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo', $site, $user);

        $this->assertInstanceOf('Denkmal_Push_Subscription', $pushSubscription);
        $this->assertSame('http://twitter.com/foo/123321foo', $pushSubscription->getEndpoint());
        $this->assertEquals($site, $pushSubscription->getSite());
        $this->assertInstanceOf('DateTime', $pushSubscription->getUpdated());
        $this->assertEquals($user, $pushSubscription->getUser());
    }

    /**
     * @expectedException CM_Db_Exception
     */
    public function testCreateDuplicate() {
        $site = $this->getMockSite();
        $user = Denkmal_Model_User::create('foo@bar.com', 'test', 'pswd');
        Denkmal_Push_Subscription::create('http://twitter.com/foo/foo1', $site, $user);
        Denkmal_Push_Subscription::create('http://twitter.com/foo/foo1', $site, $user);
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $site = $this->getMockSite();
        $pushSubscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo', $site);
        $pushSubscription->delete();
        new Denkmal_Push_Subscription($pushSubscription->getId());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDeleteWithMessage() {
        $site = $this->getMockSite();
        $subscription = Denkmal_Push_Subscription::create('http://twitter.com/foo/123321foo', $site);
        $message = Denkmal_Push_Notification_Message::create($subscription, new DateTime('2015-01-01'), ['foo' => 12]);
        $subscription->delete();
        new Denkmal_Push_Notification_Message($message->getId());
    }
}
