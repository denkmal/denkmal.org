<?php

class Denkmal_Component_PushNotificationsTest extends CMTest_TestCase {

    public function testAjax_storePush() {
        $environment = new CM_Frontend_Environment();
        $response = $this->getResponseAjax(new Denkmal_Component_PushNotifications(),
            'storePush',
            [
                'subscriptionId' => '123321',
                'endpoint'       => 'https://google.com/push',
                'user'           => null,
            ],
            $environment
        );

        $this->assertViewResponseSuccess($response);
        $this->assertCount(1, new Denkmal_Paging_PushSubscription_All());
    }
}
