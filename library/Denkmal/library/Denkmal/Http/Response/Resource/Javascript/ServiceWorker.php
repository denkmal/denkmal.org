<?php

class Denkmal_Http_Response_Resource_Javascript_ServiceWorker extends CM_Http_Response_Resource_Javascript_Abstract {

    public function __construct(CM_Http_Request_Abstract $request, CM_Service_Manager $serviceManager) {
        $this->_request = clone $request;
        $this->_site = CM_Site_Abstract::factory();

        $this->setServiceManager($serviceManager);
    }

    protected function _process() {
        $path = $this->getRender()->getLayoutPath('resource/js/service-worker.js', null, null, true, true);
        $this->_setContent((new CM_File($path))->read());
        $this->setHeader('Content-Type', 'application/javascript');
    }

    public static function match(CM_Http_Request_Abstract $request) {
        return $request->getPath() === '/service-worker.js';
    }
}
