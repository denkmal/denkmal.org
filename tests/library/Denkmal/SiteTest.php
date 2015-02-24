<?php

class Denkmal_SiteTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testEmoticonValidity() {
        CM_Emoticon::validateData();
    }

    public function testGetSetAnonymousMessagingDisabled() {
        $site = new Denkmal_Site();
        $this->assertSame(false, $site->getAnonymousMessagingDisabled());

        $site->setAnonymousMessagingDisabled(true);
        $this->assertSame(true, $site->getAnonymousMessagingDisabled());

        $site->setAnonymousMessagingDisabled(false);
        $this->assertSame(false, $site->getAnonymousMessagingDisabled());
    }
}
