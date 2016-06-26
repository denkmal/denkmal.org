<?php

class Admin_Page_Abstract extends CM_Page_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

    /** @var Denkmal_Model_Region|null */
    protected $_region;

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        $site = $response->getSite();
        if ($site instanceof Denkmal_Site_Default && $site->hasRegion()) {
            $this->_region = $site->getRegion();
        }
    }

    public function checkAccessible(CM_Frontend_Environment $environment) {
        if (!$environment->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            throw new CM_Exception_AuthRequired();
        }
    }

    /**
     * @return Denkmal_Model_Region
     * @throws CM_Exception
     */
    protected function _getRegion() {
        if (!$this->_hasRegion()) {
            throw new CM_Exception('No region available in session');
        }
        return $this->_region;
    }

    /**
     * @return bool
     */
    protected function _hasRegion() {
        return null !== $this->_region;
    }
}
