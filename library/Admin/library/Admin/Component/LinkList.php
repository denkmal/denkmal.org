<?php

class Admin_Component_LinkList extends Admin_Component_Abstract {

	public function prepare() {
		$searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

		if (null !== $searchTerm) {
			$linkList = new Denkmal_Paging_Link_Search($searchTerm);
		} else {
			$linkList = new Denkmal_Paging_Link_All();
		}
		$linkList->setPage($this->_params->getPage(), $this->_params->getInt('count', 30));

		$this->setTplParam('linkList', $linkList);
		$this->setTplParam('searchTerm', $searchTerm);
	}
}
