<?php

class Denkmal_Model_Venue extends CM_Model_Abstract {

	const TYPE = 100;

	protected function _loadData () {
		CM_Db_Db::select('denkmal_venue', array('*'), array('id' => $this->getId()))->fetch();
	}

}
