<?php

class Denkmal_Date {

	private static $_months = array(
		'Jan'       => 1,
		'Januar'    => 1,
		'Feb'       => 2,
		'Februar'   => 2,
		'Mar'       => 3,
		'März'      => 3,
		'Apr'       => 4,
		'April'     => 4,
		'Mai'       => 5,
		'Jun'       => 6,
		'Juni'      => 6,
		'Jul'       => 7,
		'Juli'      => 7,
		'Aug'       => 8,
		'August'    => 8,
		'Sep'       => 9,
		'Sept'      => 9,
		'September' => 9,
		'Okt'       => 10,
		'Oktober'   => 10,
		'Nov'       => 11,
		'November'  => 11,
		'Dez'       => 12,
		'Dezember'  => 12,
	);

	/**
	 * @var DateTime
	 */
	private $_dateTime = null;

	/**
	 * @param int|null        $day
	 * @param int|string|null $month
	 * @param int|null        $year
	 * @throws CM_Exception_Invalid
	 */
	function __construct($day = null, $month = null, $year = null) {
		if (null === $day && null === $month && $year === null) {
			$this->_dateTime = new DateTime();

		} else {
			if ($day >= 1 && $day <= 31) {
				$day = (int) $day;
			} else {
				throw new CM_Exception_Invalid('Unknown day `' . $day . '`');
			}

			if ($month >= 1 && $month <= 12) {
				$month = (int) $month;
			} elseif (array_key_exists($month, self::$_months)) {
				$month = self::$_months[$month];
			} else {
				throw new CM_Exception_Invalid('Unknown month `' . $month . '`');
			}

			$yearNow = date('Y');
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

			$this->_dateTime = new DateTime($year . '-' . $month . '-' . $day);

			if ($yearGuess) {
				$thresholdNextYearMonths = 4;
				$now = new DateTime();
				$now->sub(new DateInterval('P' . $thresholdNextYearMonths . 'M'));
				if ($this->_dateTime < $now) {
					// Date is more than [tresholdNextyearMonths] months in past -> set to next year
					$this->_dateTime->add(new DateInterval('P1Y'));
				}
			}
		}
	}

	/**
	 * @param int|int[]   $hours
	 * @param int|null    $minutes
	 * @param string|null $amPm
	 */
	public function setTime($hours, $minutes = null, $amPm = null) {
		if (is_array($hours) && count($hours) >= 2) {
			$hours = (int) $hours[0];
			$minutes = (int) $hours[1];
		}
		if (null == $hours) {
			$hours = 0;
		}
		if (null === $minutes) {
			$minutes = 0;
		}
		if ($hours == 24 && $minutes == 0) {
			$hours = 0;
			$this->_dateTime->add(new DateInterval('P1D'));
		}
		if (strtolower($amPm) == 'pm' && $hours <= 12) {
			$hours += 12;
		}
		$this->_dateTime->setTime($hours, $minutes);
	}

	/**
	 * @return string
	 */
	function __toString() {
		return $this->_dateTime->format('Y-m-d');
	}
}
