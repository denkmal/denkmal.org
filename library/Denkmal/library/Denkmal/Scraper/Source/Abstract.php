<?php

abstract class Denkmal_Scraper_Source_Abstract extends CM_Class_Abstract {

	abstract public function run();

	/**
	 * @return DateTime[]
	 */
	protected function _getDateList() {
		$day = new DateInterval('P1D');
		$dayCount = $this->_getDayCount();
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
		if (!$venue instanceof Denkmal_Model_Venue) {
			$venue = Denkmal_Model_Venue::findByNameOrAlias($venue);
			if (null === $venue) {
				$venue = Denkmal_Model_Venue::create($venue, true, false);
			}
		}
		$description = new Denkmal_Scraper_Description($description);

		if ($venue->getIgnore()) {
			return;
		}

		$eventListVenueDate = new Admin_Paging_Event_VenueDate($from, $venue);
		if ($eventListVenueDate->getCount()) {
			return;
		}

		try {
			$this->_addEvent($venue, $description, $from, $until);
		} catch (Denkmal_Scraper_Exception_InvalidEvent $e) {
			// Ignore
		}
	}

	/**
	 * @param Denkmal_Model_Venue         $venue        Location
	 * @param Denkmal_Scraper_Description $description  Description
	 * @param DateTime                    $from         From-date
	 * @param DateTime|null               $until        Until-date
	 * @throws Denkmal_Scraper_Exception_InvalidEvent
	 */
	protected function _addEvent(Denkmal_Model_Venue $venue, Denkmal_Scraper_Description $description, DateTime $from, DateTime $until = null) {
		$event = new Denkmal_Model_Event();

		$event->setVenue($venue);
		$event->setDescription((string) $description);
		$event->setTitle(null);

		if ($from < new DateTime()) {
			throw new Denkmal_Scraper_Exception_InvalidEvent('From-date is in the past');
		}
		$fromMax = new DateTime();
		$fromMax->add(new DateInterval('P' . $this->_getDayCount() . 'D'));
		if ($from > $fromMax) {
			throw new Denkmal_Scraper_Exception_InvalidEvent('From-date is too far in the future');
		}
		$event->setFrom($from);

		if ($until) {
			if ($until < $from) {
				$until->add(new DateInterval('P1D'));
			}
			if ($until < $from) {
				throw new Denkmal_Scraper_Exception_InvalidEvent('Until-date is before from-date');
			}
			$event->setUntil($until);
		}

		$event->setEnabled(false);
		$event->setQueued(true);
		$event->setHidden(false);

		$event->setStarred(false);

		$event->commit();
	}

	/**
	 * @return int
	 */
	protected function _getDayCount() {
		return (int) self::_getConfig()->dayCount;
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
