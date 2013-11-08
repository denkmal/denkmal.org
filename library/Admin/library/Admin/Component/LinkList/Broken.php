<?php

class Admin_Component_LinkList_Broken extends Admin_Component_LinkList_Abstract {

	public function prepare() {
		$linkList = new Denkmal_Paging_Link_Broken();

		$this->_prepareList($linkList);
	}
}
