<?php

class Denkmal_Http_Response_Page extends CM_Http_Response_Page {

    public function __construct(CM_Http_Request_Abstract $request, CM_Service_Manager $serviceManager) {
        $this->_request = clone $request;
        if ($region = Denkmal_Model_Region::findBySlug($this->_request->getPathPart(0))) {
            $this->_request->popPathPart(0);
        }
        $this->_request->popPathLanguage();

        $this->_site = CM_Site_Abstract::findByRequest($this->_request, ['region' => $region]);

        $this->setServiceManager($serviceManager);
    }

}
