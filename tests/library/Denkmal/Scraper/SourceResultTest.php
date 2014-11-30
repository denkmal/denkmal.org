<?php

class Denkmal_Scraper_SourceResultTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $source = new Denkmal_Scraper_Source_Programmzeitung();
        $created = new DateTime('2014-11-12');
        $sourceResult = Denkmal_Scraper_SourceResult::create($source, $created, 12);

        $this->assertGreaterThan(0, $sourceResult->getId());
        $this->assertEquals($source, $sourceResult->getScraperSource());
        $this->assertEquals($created, $sourceResult->getCreated());
        $this->assertSame(12, $sourceResult->getEventDataCount());
        $this->assertSame(null, $sourceResult->getError());
    }

    public function testCreateWithError() {
        $source = new Denkmal_Scraper_Source_Programmzeitung();
        $created = new DateTime('2014-11-12');
        $sourceResult = Denkmal_Scraper_SourceResult::create($source, $created, 12, 'hello');

        $this->assertGreaterThan(0, $sourceResult->getId());
        $this->assertEquals($source, $sourceResult->getScraperSource());
        $this->assertEquals($created, $sourceResult->getCreated());
        $this->assertSame(12, $sourceResult->getEventDataCount());
        $this->assertSame('hello', $sourceResult->getError());
    }
}
