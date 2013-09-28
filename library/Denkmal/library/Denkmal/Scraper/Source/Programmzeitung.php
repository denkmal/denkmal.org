<?php

class Denkmal_Scraper_Source_Programmzeitung extends Denkmal_Scraper_Source_Abstract {

	public function run() {
		foreach ($this->_getDateList() as $date) {
			$dateStr = $date->format('d.m.Y');
			$url = 'http://www.programmzeitung.ch/index.cfm?Datum_von=' . $dateStr . '&Datum_bis=' .
					$dateStr . '&Rubrik=6&uuid=2BCD9733D9D9424C4EF093B3E35CB44B';
			$html = new Denkmal_Scraper_String($url);
			echo PHP_EOL . $html . PHP_EOL;
			$this->processPageDate($html, $date);
		}
	}

	/**
	 * @param Denkmal_Scraper_String $string
	 * @param DateTime               $date
	 */
	public function processPageDate(Denkmal_Scraper_String $string, DateTime $date) {
		foreach ($string->matchAll('#<div class="veranstaltung">(.+?)</div>\s*<div class="ort">(.+?)(\[.+?\].*?)?(,.*?)?</div>\s*<div class="zeit">(\d+)\.(\d+)(\s+.\s+(\d+)\.(\d+))?</div>#u') as $matches) {
			$description = new Denkmal_Scraper_String($matches[1]);
			$description->replace('#^<b>(.+?)</b>\s*([^\s]+.+)$#u', '$1: $2', true);
			$description->stripTags();
			$locationName = new Denkmal_Scraper_String($matches[2]);
			$locationName->stripTags();
			$from = new Denkmal_Scraper_Date($date);
			$from->setTime($matches[5], $matches[6]);
			$until = null;
			if (isset($matches[8]) && isset($matches[9])) {
				$until = clone $from;
				$until->setTime($matches[8], $matches[9]);
			}
			$this->_addEvent($locationName, $description, $from->getDateTime(), $until->getDateTime());
		}
	}
}
