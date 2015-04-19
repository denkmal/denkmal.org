<?php

class Denkmal_Push_Notification_Provider_AbstractTest extends CMTest_TestCase {

    /**
     * @expectedException CM_Exception
     * @expectedExceptionMessage Unknown notification endpoint
     */
    public function testFactoryByEndpointUnknown() {
        Denkmal_Push_Notification_Provider_Abstract::factoryByEndpoint($this->getServiceManager(), 'foo');
    }
}
