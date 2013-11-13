<?php

class Denkmal_Scraper_Source_Hinterhof extends Denkmal_Scraper_Source_Abstract {

	public function run() {
		$html = new Denkmal_Scraper_String('http://hinterhof.ch/programm/');
		$this->processPage($html);
	}

	/**
	 * @param Denkmal_Scraper_String $html
	 */
	public function processPage(Denkmal_Scraper_String $html) {
		$html = $html->between('<ul id="events"', '<div id="footer"');

		foreach ($html->matchAll('#<div class="summary">\s*<div class="weekday">\w+ (\d+)\.(\d+) - (.+?)(?: - (.+?))?</div>\s*<div class="title">(.+?)</div>\s*</div>#') as $matches) {
			$from = new Denkmal_Scraper_Date($matches[1], $matches[2]);
			if (empty($matches[4])) {
				$genres = new Denkmal_Scraper_Genres($matches[3]);
				$description = new Denkmal_Scraper_Description($matches[5], null, $genres);
			} else {
				$genres = new Denkmal_Scraper_Genres($matches[4]);
				$description = new Denkmal_Scraper_Description($matches[5], $matches[3], $genres);
			}
			if ($from->getWeekday() == 6) {
				$from->setTime(23); // Sa
			} else {
				$from->setTime(20);
			}
			$venue = Denkmal_Model_Venue::findByNameOrAlias('Hinterhof');
			$this->_addEventAndVenue(
				$venue,
				$description,
				$from->getDateTime()
			);
		}
	}
}
