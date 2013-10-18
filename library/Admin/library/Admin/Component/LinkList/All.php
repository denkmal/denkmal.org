<?php

class Admin_Component_LinkList_All extends Admin_Component_LinkList_Abstract {

	public function prepare() {
		$searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

		if (null !== $searchTerm) {
			$linkList = new Denkmal_Paging_Link_Search($searchTerm);
		} else {
			$linkList = new Denkmal_Paging_Link_All();
		}

		$this->_prepareList($linkList, $searchTerm);
	}
}
