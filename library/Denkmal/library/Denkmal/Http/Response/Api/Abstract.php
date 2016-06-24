<?php

abstract class Denkmal_Http_Response_Api_Abstract extends CM_Http_Response_Abstract {

    /** @var Denkmal_Params */
    protected $_params;

    public function __construct(CM_Http_Request_Abstract $request, CM_Site_Abstract $site, CM_Service_Manager $serviceManager) {
        parent::__construct($request, $site, $serviceManager);
        /** @var Denkmal_Params $params */
        $this->_params = new Denkmal_Params($request->getQuery());
    }

    protected function _setContent($content) {
        $content = CM_Params::encode($content, true);
        $this->setHeader('Content-Type', 'application/json');
        $this->setHeader('Access-Control-Allow-Origin', '*');
        parent::_setContent($content);
    }
}
