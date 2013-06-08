<?php

class Denkmal_Model_Event extends CM_Model_Abstract {

	const TYPE = 101;

	protected function _loadData() {
		CM_Db_Db::select('denkmal_event', array('*'), array('id' => $this->getId()))->fetch();
	}
}
