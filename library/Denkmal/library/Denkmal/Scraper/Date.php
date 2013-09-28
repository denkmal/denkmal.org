<?php

class Denkmal_Scraper_Date extends CM_Class_Abstract {

	private static $_months = array(
		'Jan'       => 1,
		'Feb'       => 2,
		'Mar'       => 3,
		'Apr'       => 4,
		'Mai'       => 5,
		'Jun'       => 6,
		'Jul'       => 7,
		'Aug'       => 8,
		'Sep'       => 9,
		'Okt'       => 10,
		'Nov'       => 11,
		'Dez'       => 12,

		'Januar'    => 1,
		'Februar'   => 2,
		'März'      => 3,
		'April'     => 4,
		'Mai'       => 5,
		'Juni'      => 6,
		'Juli'      => 7,
		'August'    => 8,
		'September' => 9,
		'Oktober'   => 10,
		'November'  => 11,
		'Dezember'  => 12,

		'Sept'      => 9,
	);

	/**
	 * @var DateTime
	 */
	private $_date = null;

	/**
	 * @param DateTime|int    $day   Day of month (1..31) OR a Zend_Date
	 * @param string|int|null $month Month (1..12 / "Jan", "Feb", ...)
	 * @param int|null        $year  Year
	 * @throws CM_Exception_Invalid on invalid/strange values
	 */
	public function __construct($day, $month = null, $year = null) {
		if ($day instanceof DateTime) {
			$this->_date = clone $day;
		} else {
			$day = (int) $day;

			if ($day < 1 || $day > 31) {
				throw new CM_Exception_Invalid('Unknown day `' . $day . '`');
			}

			if ($month >= 1 && $month <= 12) {
				$month = (int) $month;
			} elseif (array_key_exists($month, self::$_months)) {
				$month = self::$_months[$month];
			} else {
				throw new CM_Exception_Invalid('Unknown month `' . $month . '`');
			}

			$now = new DateTime();
			$yearNow = (int) $now->format('Y');
			$yearGuess = false;
			if (isset($year)) {
				if (strlen($year) == 2) {
					$year = substr($yearNow, 0, 2) . $year;
				}
				if ($year >= $yearNow - 1 && $year <= $yearNow + 2) {
					$year = (int) $year;
				} else {
					throw new CM_Exception_Invalid('Unknown year `' . $year . '`');
				}
			} else {
				$year = $yearNow;
				$yearGuess = true;
			}

			$this->_date = new DateTime($year . '-' . $month . '-' . $day);

			if ($yearGuess) {
				$minDate = new DateTime();
				$minDate->sub($this->_getThresholdNextyearMonths());
				if ($this->_date < $minDate) {
					// Date is more than [thresholdNextyear] months in past -> set to next year
					$this->_date->add(new DateInterval('P1Y'));
				}
			}
		}

		$defaultTimeHour = (int) self::_getConfig()->defaultTimeHour;
		$this->_date->setTime($defaultTimeHour, 0);
	}

	/**
	 * @param int|int[]   $hours
	 * @param int|null    $minutes
	 * @param string|null $amPm
	 */
	public function setTime($hours, $minutes = null, $amPm = null) {
		if (is_array($hours) && count($hours) == 2) {
			$hours = $hours[0];
			$minutes = $hours[1];
		}
		if (null === $hours || $hours < 0 || $hours > 24) {
			return;
		}
		if (null === $minutes || $minutes < 0 || $minutes > 60) {
			$minutes = 0;
		}
		if (strtolower($amPm) == 'pm' && $hours <= 12) {
			$hours += 12;
		}
		if ($hours == 24 && $minutes == 0) {
			$hours = 0;
			$this->_date->add(new DateInterval('P1D'));
		}
		$this->_date->setTime($hours, $minutes);
	}

	/**
	 * @return DateTime Date
	 */
	public function getDate() {
		return $this->_date;
	}

	/**
	 * @return int Weekday (0=So, 1=Mo, 2=Di, ..., 6=Sa)
	 */
	public function getWeekday() {
		return (int) $this->_date->format('w');
	}

	public function __clone() {
		$this->_date = clone $this->_date;
	}

	/**
	 * @return DateInterval
	 */
	private function _getThresholdNextyearMonths() {
		$thresholdMonths = (int) self::_getConfig()->thresholdNextyearMonths;
		return new DateInterval('P' . $thresholdMonths . 'M');
	}

	public function __toString() {
		return $this->_date->format('r');
	}
}
