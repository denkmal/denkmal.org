<?php

class Admin_Component_SongList_Abstract extends Admin_Component_Abstract {

	public static function ajax_deleteSong(CM_Params $params, CM_ComponentFrontendHandler $handler, CM_Response_View_Ajax $response) {
		$id = $params->getInt('id');
		$link = new Denkmal_Model_Song($id);
		$link->delete();
		$response->reloadComponent();
	}
}
