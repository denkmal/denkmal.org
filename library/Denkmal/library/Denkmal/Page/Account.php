<?php

class Denkmal_Page_Account extends Denkmal_Page_Abstract {

    public function checkAccessible(CM_Frontend_Environment $environment) {
        $this->_checkViewer($environment);
    }
}
