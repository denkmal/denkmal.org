<?php

class Denkmal_Site_Region_AbstractTest extends CMTest_TestCase {

    /** @var Denkmal_Model_Region */
    private $_region;

    /** @var Denkmal_Site_Region_Abstract|PHPUnit_Framework_MockObject_MockObject */
    private $_site;

    /** @var bool */
    private $_debugBackup;

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());

        $location = CMTest_TH::createLocation();
        $this->_region = Denkmal_Model_Region::create('My Region', 'my-reg', 'MRG', $location);

        $this->_site = $this->getMockSite('Denkmal_Site_Region_Abstract', null, null, ['_getRegionSlug']);
        $this->_site->expects($this->any())->method('_getRegionSlug')->will($this->returnValue('my-reg'));

        $this->_debugBackup = CM_Bootloader::getInstance()->isDebug();
        CM_Bootloader::getInstance()->setDebug(true);
    }

    protected function tearDown() {
        CM_Bootloader::getInstance()->setDebug($this->_debugBackup);
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

    public function testFindSiteByGeoPoint() {
        $siteGraz = new Denkmal_Site_Region_Graz();
        $siteBasel = new Denkmal_Site_Region_Basel();

        $this->assertEquals($siteBasel, Denkmal_Site_Region_Abstract::findSiteByGeoPoint(new CM_Geo_Point(47.5572162, 7.5725677)));
        $this->assertEquals($siteBasel, Denkmal_Site_Region_Abstract::findSiteByGeoPoint(new CM_Geo_Point(47.530664, 7.5790373)));

        $this->assertEquals($siteGraz, Denkmal_Site_Region_Abstract::findSiteByGeoPoint(new CM_Geo_Point(47.0735683, 15.3717501)));

        $this->assertNull(Denkmal_Site_Region_Abstract::findSiteByGeoPoint(new CM_Geo_Point(41.589600, -1.208298)));
    }

}
