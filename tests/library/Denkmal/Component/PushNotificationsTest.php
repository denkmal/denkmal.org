<?php

class Denkmal_Component_PushNotificationsTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testAjax_storePushSubscription() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'subscriptionId' => '123321f',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());
    }

    public function testAjax_storePushSubscriptionTwice() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'subscriptionId' => '123321f',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $response2 = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'subscriptionId' => '123321f',
            'endpoint'       => 'https://google.com/push',
            'user'           => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertViewResponseSuccess($response2);
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());
    }
}
