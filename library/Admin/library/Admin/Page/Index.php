<?php

class Admin_Page_Index extends Admin_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        parent::prepareResponse($environment, $response);

        $response->redirect('Admin_Page_Events');
    }
}
