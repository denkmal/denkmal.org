<?php

/**
 * @method Denkmal_Params getParams()
 */
abstract class Denkmal_Component_Abstract extends CM_Component_Abstract {

    /** @var  Denkmal_Params */
    protected $_params;

    public function checkAccessible(CM_Frontend_Environment $environment) {
    }
}
