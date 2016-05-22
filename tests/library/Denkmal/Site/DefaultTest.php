<?php

class Denkmal_Site_DefaultTest extends CMTest_TestCase {

    public function testHasRegion() {
        $site = new Denkmal_Site_Default();
        $this->assertSame(false, $site->hasRegion());
    }

    /**
     * @expectedException CM_Exception
     */
    public function testGetRegion() {
        $site = new Denkmal_Site_Default();
        $site->getRegion();
    }

}
