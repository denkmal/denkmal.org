<?php

class Denkmal_Page_Index extends Denkmal_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        parent::prepareResponse($environment, $response);
        if ($response->getRedirectUrl()) {
            return;
        }

        if ($this->_hasRegion()) {
            $response->redirect('Denkmal_Page_Events');
        } else {
            $response->redirect('Denkmal_Page_Regions');
        }
    }

}
