<?php

class Denkmal_Scraper_DescriptionTest extends CMTest_TestCase {

    public function testGetTitleAndDescriptionWithBoth() {
        $description = new Denkmal_Scraper_Description('Meine Beschreibung', 'Mein Titel');

        $this->assertSame('Mein Titel: Meine Beschreibung', $description->getTitleAndDescription());
    }

    public function testGetTitleAndDescriptionWithTitle() {
        $description = new Denkmal_Scraper_Description(null, 'Mein Titel');

        $this->assertSame('Mein Titel', $description->getTitleAndDescription());
    }

    public function testGetTitleAndDescriptionWithDescription() {
        $description = new Denkmal_Scraper_Description('Meine Beschreibung');

        $this->assertSame('Meine Beschreibung', $description->getTitleAndDescription());
    }

    public function testGetTitleAndDescriptionWithNothing() {
        $description = new Denkmal_Scraper_Description();

        $this->assertSame('', $description->getTitleAndDescription());
    }

    public function testGetTitleAndDescriptionCapsLock() {
        $description = new Denkmal_Scraper_Description('MEINE BESCHREIBUNG YO');

        $this->assertSame('Meine Beschreibung YO', $description->getTitleAndDescription());
    }

    public function testGetGenres() {
        $genres = new Denkmal_Scraper_Genres('pop, rock');
        $description = new Denkmal_Scraper_Description('Meine Beschreibung', null, $genres);

        $this->assertSame('Pop, rock', $description->getGenres());
    }

    public function testGetGenresEmpty() {
        $genres = new Denkmal_Scraper_Genres('');
        $description = new Denkmal_Scraper_Description('Meine Beschreibung', null, $genres);

        $this->assertSame(null, $description->getGenres());
    }

    public function testGetGenresNone() {
        $description = new Denkmal_Scraper_Description('Meine Beschreibung');

        $this->assertSame(null, $description->getGenres());
    }
}
