<?php

class Denkmal_Component_EventPreview extends Denkmal_Component_Abstract {

	public function prepare() {
		$event = $this->_params->getEvent('event');
		$venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();

		$fromDate = $event->getFrom();

		$fromDateDisplay = clone $fromDate;

		$fromDateDisplay->sub(new DateInterval('PT' . Denkmal_Site::getDayOffset() . 'H'));

		if ($fromDate->format('d.m.Y') != $fromDateDisplay->format('d.m.Y')) {
			$this->setTplParam('fromDateDisplay', $fromDateDisplay);
		}
		$this->setTplParam('event', $event);
		$this->setTplParam('venue', $venue);

		$this->_params = CM_Params::factory(); // Empty params to not send them to client
	}

	private function _matchDayNames($day) {
		switch ($day) {
			case 0:
				return 'So';
				break;
			case 1:
				return 'Mo';
				break;
			case 2:
				return 'Di';
				break;
			case 3:
				return 'Mi';
				break;
			case 4:
				return 'Do';
				break;
			case 5:
				return 'Fr';
				break;
			case 6:
				return 'Sa';
				break;
			default:
				throw new CM_Exception_Invalid('Day with index `' . $day . '` does not exist.');
		}
	}
}
