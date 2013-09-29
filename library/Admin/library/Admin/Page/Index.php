<?php

class Admin_Page_Index extends Admin_Page_Abstract {

	public function prepareResponse(CM_Response_Page $response) {
		$now = Denkmal_Site::getCurrentDate();

		$response->redirect('Admin_Page_Events', array('date' => $now->format('Y-n-j')));
	}
}
