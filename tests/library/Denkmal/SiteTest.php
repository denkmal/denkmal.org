<?php

class Denkmal_SiteTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testEmoticonValidity() {
        CM_Emoticon::validateData();
    }
}
