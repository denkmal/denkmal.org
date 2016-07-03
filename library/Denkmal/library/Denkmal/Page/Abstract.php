<?php

abstract class Denkmal_Page_Abstract extends CM_Page_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

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

        /** @var Denkmal_Site_Default $site */
        $site = $response->getSite();
        if ($this->_requiresRegion() && !$site->hasRegion()) {
            $url = $response->getRender()->getUrlPage('Denkmal_Page_Index', null, new Denkmal_Site_Default());
            $response->redirectUrl($url);
            return;
        }
    }

    /**
     * @return bool
     */
    protected function _requiresRegion() {
        return false;
    }
}
