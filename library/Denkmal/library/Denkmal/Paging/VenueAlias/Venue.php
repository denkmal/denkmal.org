<?php

class Denkmal_Paging_VenueAlias_Venue extends Denkmal_Paging_VenueAlias_Abstract {

	/**
	 * @param Denkmal_Model_Venue $venue
	 */
	public function __construct(Denkmal_Model_Venue $venue) {
		$where = '`venue` = ' . $venue->getId();
		$source = new CM_PagingSource_Sql('id', 'denkmal_model_venuealias', $where, '`name`');
		parent::__construct($source);
	}
}
