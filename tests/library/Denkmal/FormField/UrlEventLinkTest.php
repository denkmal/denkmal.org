<?php

class Denkmal_FormField_UrlEventLinkTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testValidateFacebookMobile() {
        $field = new Denkmal_FormField_UrlEventLink();

        $environment = new CM_Frontend_Environment();
        $this->assertSame(
            'https://www.facebook.com/events/772968946193722',
            $field->validate($environment, 'https://m.facebook.com/events/772968946193722')
        );
    }
}
