<?php

class Admin_Component_LinkList extends Admin_Component_Abstract {

	public function prepare() {
		$linkList = new Denkmal_Paging_Link_All();

		$this->setTplParam('linkList', $linkList);
	}

	public static function ajax_deleteLink(CM_Params $params, CM_ComponentFrontendHandler $handler, CM_Response_View_Ajax $response) {
		$id = $params->getInt('id');
		$link = new Denkmal_Model_Link($id);
		$link->delete();
		$response->reloadComponent();
	}
}
