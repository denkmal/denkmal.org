<?php

class Admin_Page_Error_NotFound extends Admin_Page_Abstract {

	public function prepareResponse(CM_Response_Page $response) {
		$response->setHeaderNotfound();
	}
}
