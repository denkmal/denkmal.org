<?php

class Denkmal_Page_Error_NotFound extends Denkmal_Page_Abstract {

    public function prepareResponse(CM_Response_Page $response) {
        $response->setHeaderNotfound();
    }
}
