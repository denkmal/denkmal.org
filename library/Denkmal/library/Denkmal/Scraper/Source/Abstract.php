<?php

abstract class Denkmal_Scraper_Source_Abstract extends CM_Class_Abstract {

	abstract public function run();

	/**
	 * @return DateTime[]
	 */
	protected function _getDateList() {
		$day = new DateInterval('P1D');
		$dayCount = (int) self::_getConfig()->dayCount;
		$dateList = array();
		$date = new DateTime();
		$date->setTime(0, 0, 0);
		for ($i = 0; $i < $dayCount; $i++) {
			$dateList[] = clone $date;
			$date->add($day);
		}
		return $dateList;
	}

	/**
	 * @param Denkmal_Model_Venue|string $venue        Location-name
	 * @param string                     $description  Description
	 * @param DateTime                   $from         From-date
	 * @param DateTime|null              $until        Until-date
	 */
	protected function _addEventAndVenue($venue, $description, DateTime $from, DateTime $until = null) {
		if (is_string($venue)) {
			$venue = Denkmal_Model_Venue::findByNameOrAlias($venue);
			if (null === $venue) {
				$venue = Denkmal_Model_Venue::create($venue, true, false, false);
			}
		}
//		$this->_addEvent($venue, $description, $from, $until);
	}

	/**
	 * @return Denkmal_Scraper_Source_Abstract[]
	 */
	public static function getAll() {
		$scraperList = array();
		foreach (CM_Util::getClassChildren('Denkmal_Scraper_Source_Abstract') as $className) {
			$scraperList[] = new $className;
		}
		return $scraperList;
	}
}
