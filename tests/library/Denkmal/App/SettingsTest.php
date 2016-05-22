<?php

class Denkmal_App_SettingsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetSetAnonymousMessagingDisabled() {
        $settings = new Denkmal_App_Settings();
        $this->assertSame(false, $settings->getAnonymousMessagingDisabled());

        $settings->setAnonymousMessagingDisabled(true);
        $this->assertSame(true, $settings->getAnonymousMessagingDisabled());

        $settings->setAnonymousMessagingDisabled(false);
        $this->assertSame(false, $settings->getAnonymousMessagingDisabled());
    }

}
