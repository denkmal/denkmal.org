<?php

class Denkmal_Paging_Event_Abstract extends CM_Paging_Abstract {

	protected function _processItem($itemRaw) {
		return new Denkmal_Model_Event($itemRaw);
	}
}
