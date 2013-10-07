<?php

class Admin_Component_LinkList extends Admin_Component_Abstract {

	public function prepare() {
		$linkList = new Denkmal_Paging_Link_All();
		$linkList->setPage($this->_params->getPage(), $this->_params->getInt('count', 30));

		$this->setTplParam('linkList', $linkList);
	}
}
