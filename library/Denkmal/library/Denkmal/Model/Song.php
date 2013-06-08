<?php

class Denkmal_Model_Song extends CM_Model_Abstract {

	const TYPE = 102;

	protected function _loadData() {
		CM_Db_Db::select('denkmal_song', array('*'), array('id' => $this->getId()))->fetch();
	}
}
