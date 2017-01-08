<?php

class Denkmal_Form_Logout extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerAction(new Denkmal_FormAction_Logout_Process($this));
    }

    protected function _getRequiredFields() {
        return [];
    }

}
