<?php

class Denkmal_Model_RegionTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $country = CM_Model_Location::createCountry('FooCountry', 'FC');
        $locationCity = CM_Model_Location::createCity($country, 'BarCity', 47.598528, 7.5615583);
        $region = Denkmal_Model_Region::create('foo', 'bar', 'baz', $locationCity);

        $this->assertInstanceOf('Denkmal_Model_Region', $region);
        $this->assertSame('foo', $region->getName());
        $this->assertSame('bar', $region->getSlug());
        $this->assertSame('baz', $region->getAbbreviation());
        $this->assertEquals($locationCity, $region->getLocation());

        $timeZone = $region->getTimeZone();
        $this->assertInstanceOf('DateTimeZone', $timeZone);
        $this->assertSame('Europe/Zurich', $timeZone->getName());
    }
}
