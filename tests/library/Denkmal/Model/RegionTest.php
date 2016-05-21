<?php

class Denkmal_Model_RegionTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $country = CM_Model_Location::createCountry('FooCountry', 'FC');
        $locationCity = CM_Model_Location::createCity($country, 'BarCity' , -1.0 , 2.0 );
        $region = Denkmal_Model_Region::create('foo', 'bar', 'baz' ,  $locationCity);

        $this->assertInstanceOf('Denkmal_Model_Region', $region);
        $this->assertSame('foo', $region->getName());
        $this->assertSame('bar', $region->getAbbreviation());
        $this->assertSame('baz', $region->getSlug());
        $this->assertEquals($locationCity, $region->getLocation());
    }
}
