<?php

class Denkmal_Scraper_GenresTest extends CMTest_TestCase {

    public function testGetString() {
        $genres = new Denkmal_Scraper_Genres('FOO, BAR / MEGA');

        $this->assertSame('Foo, bar, mega', $genres->getString());
    }

}
