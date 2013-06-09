<?php

class Admin_Component_LinkList extends Admin_Component_Abstract {

	public function prepare() {
		$links = new Denkmal_Paging_Link_All();

		$this->setTplParam('links', $links);
	}
}
