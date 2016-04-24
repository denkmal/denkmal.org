<?php

class Denkmal_Scraper_GenresTest extends CMTest_TestCase {

    public function testGetString() {
        $genres = new Denkmal_Scraper_Genres('genre1, genre2 / GENRE3, gen re4 & genre5 | genre6');

        $this->assertSame('Genre1, genre2, genre3, gen re4, genre5, genre6', $genres->getString());
    }

    public function testGetStringWithEmptyOnes() {
        $genres = new Denkmal_Scraper_Genres(',,FOO, BAR /// MEGA');

        $this->assertSame('Foo, bar, mega', $genres->getString());
    }

}
