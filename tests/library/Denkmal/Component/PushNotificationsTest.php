<?php

class Denkmal_Component_PushNotificationsTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    /**
     * @expectedException CM_Exception
     * @expectedExceptionMessage Unknown notification endpoint
     */
    public function testAjax_storePushSubscriptionUnknownEndpoint() {
        $environment = new CM_Frontend_Environment();
        $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => true,
            'endpoint' => 'foo',
            'user'     => null,
        ], $environment);
    }

    public function testAjax_storePushSubscription() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => true,
            'endpoint' => 'https://android.googleapis.com/gcm/send/123321f',
            'user'     => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());
    }

    public function testAjax_storePushSubscriptionUpdate() {
        $site1 = $this->getMockSite();
        $request = $this->createRequestAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => true,
            'endpoint' => 'https://android.googleapis.com/gcm/send/foo1',
            'user'     => null,
        ], null, null, $site1);
        /** @var CM_Http_Response_View_Abstract $response */
        $response = $this->processRequest($request);

        $this->assertViewResponseSuccess($response);
        $pushSubscription = Denkmal_Push_Subscription::findByEndpoint('https://android.googleapis.com/gcm/send/foo1');
        $this->assertNull($pushSubscription->getUser());
        $this->assertEquals($site1, $pushSubscription->getSite());

        $site2 = $this->getMockSite();
        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'passwd');
        $request = $this->createRequestAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => true,
            'endpoint' => 'https://android.googleapis.com/gcm/send/foo1',
            'user'     => $user,
        ], null, null, $site2);
        /** @var CM_Http_Response_View_Abstract $response */
        $response = $this->processRequest($request);

        $this->assertViewResponseSuccess($response);
        $pushSubscription = Denkmal_Push_Subscription::findByEndpoint('https://android.googleapis.com/gcm/send/foo1');
        $this->assertEquals($user, $pushSubscription->getUser());
        $this->assertEquals($site2, $pushSubscription->getSite());
    }

    public function testAjax_storePushSubscriptionTwice() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => true,
            'endpoint' => 'https://android.googleapis.com/gcm/send/123321f',
            'user'     => null,
        ], $environment);

        $response2 = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => true,
            'endpoint' => 'https://android.googleapis.com/gcm/send/123321f',
            'user'     => null,
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertViewResponseSuccess($response2);
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());
    }

    public function testAjax_storePushSubscriptionRemoval() {
        $environment = new CM_Frontend_Environment();
        Denkmal_Push_Subscription::create('https://android.googleapis.com/gcm/send/foo1', $environment->getSite());
        $this->assertCount(1, new Denkmal_Push_SubscriptionList_All());

        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(), 'storePushSubscription', [
            'state'    => false,
            'endpoint' => 'https://android.googleapis.com/gcm/send/foo1',
        ], $environment);

        $this->assertViewResponseSuccess($response);
        $this->assertCount(0, new Denkmal_Push_SubscriptionList_All());
    }
}
