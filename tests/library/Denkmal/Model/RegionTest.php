<?php

class Denkmal_Model_RegionTest extends CMTest_TestCase {

    /** @var CM_Model_Location */
    protected $_city;

    protected function setUp() {
        $country = CM_Model_Location::createCountry('FooCountry', 'FC');
        $this->_city = CM_Model_Location::createCity($country, 'BarCity', 47.598528, 7.5615583);
    }

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $region = Denkmal_Model_Region::create('foo', 'bar', 'baz', $this->_city);
        $this->assertInstanceOf('Denkmal_Model_Region', $region);
        $this->assertSame('foo', $region->getName());
        $this->assertSame('bar', $region->getSlug());
        $this->assertSame('baz', $region->getAbbreviation());
        $this->assertEquals($this->_city, $region->getLocation());

        $timeZone = $region->getTimeZone();
        $this->assertInstanceOf('DateTimeZone', $timeZone);
        $this->assertSame('Europe/Zurich', $timeZone->getName());
    }

    public function testFindBySlug() {
        $region = Denkmal_Model_Region::create('foo', 'slug', 'baz' , $this->_city);
        $region2 = Denkmal_Model_Region::create('fooBar', 'slug2', 'baz2' , $this->_city);
        
        $this->assertEquals($region2, Denkmal_Model_Region::findBySlug('slug2'));
        $this->assertEquals($region, Denkmal_Model_Region::findBySlug('slug'));
        $this->assertNull(Denkmal_Model_Region::findBySlug('slug3'));
    }
}
