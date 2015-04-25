<?php

class Denkmal_Component_PushNotificationsTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testAjax_storePushSubscription() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'          => true,
            'subscriptionId' => '123321f',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());
    }

    public function testAjax_storePushSubscriptionUpdate() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'          => true,
            'subscriptionId' => 'foo1',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $pushSubscription = Denkmal_Push_Subscription::findBySubscriptionIdAndEndpoint('foo1', 'https://google.com/push');
        $this->assertNull($pushSubscription->getUser());

        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'passwd');
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'          => true,
            'subscriptionId' => 'foo1',
            'endpoint'       => 'https://google.com/push',
            'user'           => $user,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $pushSubscription = Denkmal_Push_Subscription::findBySubscriptionIdAndEndpoint('foo1', 'https://google.com/push');
        $this->assertEquals($user, $pushSubscription->getUser());
    }

    public function testAjax_storePushSubscriptionTwice() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'          => true,
            'subscriptionId' => '123321f',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $response2 = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'          => true,
            'subscriptionId' => '123321f',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertViewResponseSuccess($response2);
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());
    }

    public function testAjax_storePushSubscriptionRemoval() {
        Denkmal_Push_Subscription::create('foo1', 'https://google.com/push');
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());

        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'          => false,
            'subscriptionId' => 'foo1',
            'endpoint'       => 'https://google.com/push',
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertCount(0, new Denkmal_Push_SubscriptionList_All());
    }
}
