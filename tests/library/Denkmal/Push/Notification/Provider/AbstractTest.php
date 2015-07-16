<?php

class Denkmal_Push_Notification_Provider_AbstractTest extends CMTest_TestCase {

    /**
     * @expectedException CM_Exception
     * @expectedExceptionMessage Unknown notification endpoint
     */
    public function testFactoryByEndpointUnknown() {
        Denkmal_Push_Notification_Provider_Abstract::factoryByEndpoint($this->getServiceManager(), 'foo');
    }

    public function testFactoryByEndpointGoogleCloudMessaging() {
        $provider = Denkmal_Push_Notification_Provider_Abstract::factoryByEndpoint($this->getServiceManager(), 'https://android.googleapis.com/gcm/send');
        $this->assertInstanceOf('Denkmal_Push_Notification_Provider_GoogleCloudMessaging', $provider);
    }

    public function testFindByEndpointUnknown() {
        $provider = Denkmal_Push_Notification_Provider_Abstract::findByEndpoint($this->getServiceManager(), 'foo');
        $this->assertNull($provider);
    }

    public function testFindByEndpointGoogleCloudMessaging() {
        $provider = Denkmal_Push_Notification_Provider_Abstract::findByEndpoint($this->getServiceManager(), 'https://android.googleapis.com/gcm/send');
        $this->assertInstanceOf('Denkmal_Push_Notification_Provider_GoogleCloudMessaging', $provider);
    }
}
