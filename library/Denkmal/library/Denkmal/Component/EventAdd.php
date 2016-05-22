<?php

class Denkmal_Component_EventAdd extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->_params->getRegion('region');

        $viewResponse->set('region', $region);
    }
}
