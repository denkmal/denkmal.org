<?php

abstract class Denkmal_Http_Response_Api_Abstract extends CM_Http_Response_Abstract {

    /**
     * @var Denkmal_Params
     */
    protected $_params;

    public function __construct(CM_Http_Request_Abstract $request, CM_Service_Manager $serviceManager) {
        $this->_request = clone $request;
        $this->_site = CM_Site_Abstract::factory();
        $this->_params = CM_Params::factory($request->getQuery());

        $this->setServiceManager($serviceManager);
    }

    public static function match(CM_Http_Request_Abstract $request) {
        return $request->getPathPart(0) === 'api';
    }

    protected function _setContent($content) {
        $content = CM_Params::encode($content, true);
        $this->setHeader('Content-Type', 'application/json');
        $this->setHeader('Access-Control-Allow-Origin', '*');
        parent::_setContent($content);
    }
}
