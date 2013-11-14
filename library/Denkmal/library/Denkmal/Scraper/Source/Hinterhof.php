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

		foreach ($html->matchAll('#<div class="summary">\s*<div class="weekday">\w+ (?<day>\d+)\.(?<month>\d+) -\s*?(?<titleAndGenres>.+?)?</div>\s*<div class="title">(?<description>.+?)</div>\s*</div>#') as $matches) {
			//
			$title = null;
			$genres = null;

			$matches['titleAndGenres'] = trim($matches['titleAndGenres']);
			if (!empty($matches['titleAndGenres'])) {
				$titleAndGenres = new Denkmal_Scraper_String($matches['titleAndGenres']) ;
				$titleAndGenresMatch = $titleAndGenres->match('#(?<title><b>.*</b>)?( - )?((?<genres>.+?))?$#');
				if($titleAndGenresMatch['title'] != ''){
					$title = $titleAndGenresMatch['title'];
				}
				if($titleAndGenresMatch['genres'] != ''){
					$genres = new Denkmal_Scraper_Genres($titleAndGenresMatch['genres']);
				}
			}
			$description = new Denkmal_Scraper_Description($matches['description'], $title, $genres);

			$from = new Denkmal_Scraper_Date($matches['day'], $matches['month']);
			if ($from->getWeekday() == 6) {
				$from->setTime(23); // Sa
			} else {
				$from->setTime(20);
			}

			$this->_addEventAndVenue(
				'Hinterhof',
				$description,
				$from->getDateTime()
			);
		}
	}
}
