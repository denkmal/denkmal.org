<?php

class Admin_FormAction_Search_Process extends Admin_FormAction_Abstract {

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$searchTerm = $params->getString('searchTerm', '');
		$urlPage = $params->getString('urlPage');

		$response->redirect($urlPage, array('searchTerm' => $searchTerm));
	}
}
