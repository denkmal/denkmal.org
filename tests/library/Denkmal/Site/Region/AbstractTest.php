<?php

class Denkmal_Site_Region_AbstractTest extends CMTest_TestCase {

    /** @var Denkmal_Model_Region */
    private $_region;

    /** @var Denkmal_Site_Region_Abstract|PHPUnit_Framework_MockObject_MockObject */
    private $_site;

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());

        $location = CMTest_TH::createLocation();
        $this->_region = Denkmal_Model_Region::create('My Region', 'my-reg', 'MRG', $location);

        $this->_site = $this->getMockSite('Denkmal_Site_Region_Abstract', null, null, ['_getRegionSlug']);
        $this->_site->expects($this->any())->method('_getRegionSlug')->will($this->returnValue('my-reg'));
    }

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testHasRegion() {
        $this->assertSame(true, $this->_site->hasRegion());
    }

    public function testGetRegion() {
        $this->assertEquals($this->_region, $this->_site->getRegion());
    }

    public function testGetTheme() {
        $this->assertSame('region-my-reg', $this->_site->getTheme());
    }

}
