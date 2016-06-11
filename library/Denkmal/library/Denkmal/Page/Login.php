<?php

class Denkmal_Page_Login extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $emailAddress = $environment->getSite()->getEmailAddress();
        if ($this->_hasRegion()) {
            $emailAddress = $this->_getRegion()->getEmailAddress();
        }

        $viewResponse->set('emailAddress', $emailAddress);
    }
}
