<?php

class Denkmal_Model_RegionTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $city = DenkmalTest_TH::createLocationCity();
        $region = Denkmal_Model_Region::create('foo', 'bar', 'baz', $city);
        $this->assertInstanceOf('Denkmal_Model_Region', $region);
        $this->assertSame('foo', $region->getName());
        $this->assertSame('bar', $region->getSlug());
        $this->assertSame('baz', $region->getAbbreviation());
        $this->assertEquals($city, $region->getLocation());

        $timeZone = $region->getTimeZone();
        $this->assertInstanceOf('DateTimeZone', $timeZone);
        $this->assertSame('America/New_York', $timeZone->getName());
    }

    public function testFindBySlug() {
        $city = DenkmalTest_TH::createLocationCity();
        $region = Denkmal_Model_Region::create('foo', 'slug', 'baz', $city);
        $region2 = Denkmal_Model_Region::create('fooBar', 'slug2', 'baz2', $city);

        $this->assertEquals($region2, Denkmal_Model_Region::findBySlug('slug2'));
        $this->assertEquals($region, Denkmal_Model_Region::findBySlug('slug'));
        $this->assertNull(Denkmal_Model_Region::findBySlug('slug3'));
    }

    public function testGetBySlug() {
        $city = DenkmalTest_TH::createLocationCity();
        $region = Denkmal_Model_Region::create('foo', 'basel', 'BSL', $city);
        $region2 = Denkmal_Model_Region::create('fooBar', 'frankfurt', 'FRA', $city);

        $this->assertEquals($region, Denkmal_Model_Region::getBySlug('basel'));
        $this->assertEquals($region2, Denkmal_Model_Region::getBySlug('frankfurt'));
        $exception = $this->catchException(function () {
            Denkmal_Model_Region::getBySlug('berlin');
        });

        $this->assertInstanceOf('CM_Exception_Nonexistent', $exception);
        $this->assertSame('Region with slug `berlin` does not exist', $exception->getMessage());
    }
}
