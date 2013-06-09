<?php

class Admin_Component_VenueAliasList extends Admin_Component_Abstract {

	public function prepare() {
		$venue = $this->_params->getVenue('venue');

		$venueAliasList = new Denkmal_Paging_VenueAlias_Venue($venue);

		$this->setTplParam('venueAliasList', $venueAliasList);
	}
}
