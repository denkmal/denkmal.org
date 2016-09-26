<?php

class Denkmal_Model_FacebookPageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $facebookPage = Denkmal_Model_FacebookPage::create('12345', 'My Page');
        $this->assertSame('12345', $facebookPage->getFacebookId());
        $this->assertSame('My Page', $facebookPage->getName());
        $this->assertSame(0, $facebookPage->getFailedCount());
    }

}
