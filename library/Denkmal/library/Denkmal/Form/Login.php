<?php

class Denkmal_Form_Login extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'login']));
        $this->registerField(new CM_FormField_Password(['name' => 'password']));

        $this->registerAction(new Denkmal_FormAction_Login_Process($this));
    }

    protected function _getRequiredFields() {
        return array('login', 'password');
    }

}
