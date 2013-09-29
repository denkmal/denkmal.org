<?php

class Denkmal_Scraper_DescriptionTest extends CMTest_TestCase {

	public function testGetDescriptionAndGenres() {
		$description = new Denkmal_Scraper_Description('foo bar');

		$this->assertSame('Foo bar', $description->getDescriptionAndGenres());
	}
}
