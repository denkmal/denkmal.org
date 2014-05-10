<?php

class Denkmal_Scraper_DescriptionTest extends CMTest_TestCase {

    public function testGetDescriptionAndGenres() {
        $description = new Denkmal_Scraper_Description('foo bar');

        $this->assertSame('Foo bar', $description->getDescriptionAndGenres());
        $this->assertSame(null, $description->getTitle());
    }

    public function testGetDescriptionAndGenresWithGenres() {
        $genres = new Denkmal_Scraper_Genres('rock, rap');
        $description = new Denkmal_Scraper_Description('foo bar', null, $genres);

        $this->assertSame('Foo bar. Rock, rap', $description->getDescriptionAndGenres());
        $this->assertSame(null, $description->getTitle());
    }

    public function testWithTitle() {
        $description = new Denkmal_Scraper_Description('Meine Beschreibung', 'Mein Titel');

        $this->assertSame('Meine Beschreibung', $description->getDescriptionAndGenres());
        $this->assertSame('Mein Titel', $description->getTitle());
    }

    public function testTitleOnly() {
        $description = new Denkmal_Scraper_Description(null, 'foo bar');

        $this->assertSame('Foo bar', $description->getDescriptionAndGenres());
        $this->assertSame(null, $description->getTitle());
    }

    public function testGetAll() {
        $description = new Denkmal_Scraper_Description('foo', 'bar');

        $this->assertSame('Bar: Foo', $description->getAll());
    }

    public function testGetAllDescriptionOnly() {
        $description = new Denkmal_Scraper_Description('foo');

        $this->assertSame('Foo', $description->getAll());
    }

    public function testCapsLock() {
        $description = new Denkmal_Scraper_Description('MY FOOD');

        $this->assertSame('MY Food', $description->getAll());
    }
}
