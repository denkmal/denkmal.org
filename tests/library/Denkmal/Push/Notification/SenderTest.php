<?php

class Denkmal_Push_Notification_SenderTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testSendNotifications() {
        $message = new Denkmal_Push_Notification_Message();
        $message->setExpires(new DateTime('2015-01-01'));
        $message->setData(['foo' => 'bar']);

        $site = $this->getMockSite();
        /** @var Denkmal_Push_Subscription[] $subscriptionList */
        $subscriptionList = [
            $subscriptionFoo1 = Denkmal_Push_Subscription::create('foo/foo1', $site),
            $subscriptionBar1 = Denkmal_Push_Subscription::create('bar/bar1', $site),
            $subscriptionFoo2 = Denkmal_Push_Subscription::create('foo/foo2', $site),
            $subscriptionBar2 = Denkmal_Push_Subscription::create('bar/bar2', $site),
        ];
        $subscriptionListFoo = [$subscriptionFoo1, $subscriptionFoo2];
        $subscriptionListBar = [$subscriptionBar1, $subscriptionBar2];

        $providerClass = $this->mockClass('Denkmal_Push_Notification_Provider_Abstract');
        $providerFoo = $providerClass->newInstance([$this->getServiceManager()]);
        $providerFoo->mockMethod('getIdentifier')->set('foo');
        $sendNotificationFooMethod = $providerFoo->mockMethod('sendNotifications')
            ->set(function (array $subscriptionList, Denkmal_Push_Notification_Message $message) use ($subscriptionListFoo) {
                $this->assertEquals($subscriptionListFoo, $subscriptionList);
            });

        $providerBar = $providerClass->newInstance([$this->getServiceManager()]);
        $providerFoo->mockMethod('getIdentifier')->set('bar');
        $sendNotificationBarMethod = $providerBar->mockMethod('sendNotifications')
            ->set(function (array $subscriptionList, Denkmal_Push_Notification_Message $message) use ($subscriptionListBar) {
                $this->assertEquals($subscriptionListBar, $subscriptionList);
            });

        $senderClass = $this->mockClass('Denkmal_Push_Notification_Sender');
        $senderClass->mockMethod('_getProvider')
            ->at(0, function (Denkmal_Push_Subscription $subscription) use ($providerFoo) {
                $this->assertSame('foo/foo1', $subscription->getEndpoint());
                return $providerFoo;
            })
            ->at(1, function (Denkmal_Push_Subscription $subscription) use ($providerBar) {
                $this->assertSame('bar/bar1', $subscription->getEndpoint());
                return $providerBar;
            })
            ->at(2, function (Denkmal_Push_Subscription $subscription) use ($providerFoo) {
                $this->assertSame('foo/foo2', $subscription->getEndpoint());
                return $providerFoo;
            })
            ->at(3, function (Denkmal_Push_Subscription $subscription) use ($providerBar) {
                $this->assertSame('bar/bar2', $subscription->getEndpoint());
                return $providerBar;
            });

        $clientConfig = [];
        $sender = $senderClass->newInstance([$clientConfig]);
        /** @var Denkmal_Push_Notification_Sender $sender */
        $sender->setServiceManager($this->getServiceManager());
        $sender->sendNotifications($subscriptionList, $message);

        $this->assertSame(1, $sendNotificationFooMethod->getCallCount());
        $this->assertSame(1, $sendNotificationBarMethod->getCallCount());

        foreach ($subscriptionList as $subscription) {
            $this->assertCount(1, $subscription->getMessageList());
            /** @var Denkmal_Push_Notification_Message $messageFromSubscription */
            $messageFromSubscription = $subscription->getMessageList()->getItem(0);
            $this->assertEquals($message->getExpires(), $messageFromSubscription->getExpires());
            $this->assertEquals($message->getData(), $messageFromSubscription->getData());
        }
    }
}
