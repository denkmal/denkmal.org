<?php

class Admin_Form_Logout extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerAction(new Admin_FormAction_Logout_Process($this));
    }
}
