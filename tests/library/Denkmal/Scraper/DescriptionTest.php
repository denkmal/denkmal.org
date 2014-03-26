<?php

class Denkmal_Scraper_DescriptionTest extends CMTest_TestCase {

    public function testGetDescriptionAndGenres() {
        $description = new Denkmal_Scraper_Description('foo bar');

        $this->assertSame('Foo bar', $description->getDescriptionAndGenres());
    }

    public function testGetDescriptionAndGenresWithGenres() {
        $genres = new Denkmal_Scraper_Genres('rock, rap');
        $description = new Denkmal_Scraper_Description('foo bar', null, $genres);

        $this->assertSame('Foo bar. Rock, rap', $description->getDescriptionAndGenres());
    }
}
