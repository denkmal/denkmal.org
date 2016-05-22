<?php

abstract class Denkmal_Page_Abstract extends CM_Page_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

    /** @var Denkmal_Model_Region|null */
    protected $_region;

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        $settings = new Denkmal_App_Settings();
        $suspension = $settings->getSuspension();
        if ($suspension->isActive()) {
            if (!$this instanceof Denkmal_Page_Suspended) {
                $response->redirect('Denkmal_Page_Suspended');
                return;
            }
        } else {
            if ($this instanceof Denkmal_Page_Suspended) {
                $response->redirect('Denkmal_Page_Index');
                return;
            }
        }

        $site = $response->getSite();
        if ($site instanceof Denkmal_Site_Default && $site->hasRegion()) {
            $this->_region = $site->getRegion();
        } elseif ($this->_requiresRegion()) {
            $url = $response->getRender()->getUrlPage('Denkmal_Page_Index', null, new Denkmal_Site_Default());
            $response->redirectUrl($url);
            return;
        }
    }

    /**
     * @return Denkmal_Model_Region
     * @throws CM_Exception
     */
    protected function _getRegion() {
        if (!$this->_hasRegion()) {
            throw new CM_Exception('No region detected from site');
        }
        return $this->_region;
    }

    /**
     * @return bool
     */
    protected function _hasRegion() {
        return null !== $this->_region;
    }

    /**
     * @return bool
     */
    protected function _requiresRegion() {
        return false;
    }
}
