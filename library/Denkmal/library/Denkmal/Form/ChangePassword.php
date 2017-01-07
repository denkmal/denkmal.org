<?php

class Denkmal_Form_ChangePassword extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Password(['name' => 'old_password']));
        $this->registerField(new CM_FormField_Password(['name' => 'new_password']));
        $this->registerField(new CM_FormField_Password(['name' => 'new_password_confirm']));

        $this->registerAction(new Denkmal_FormAction_ChangePassword_Process($this));
    }

    protected function _getRequiredFields() {
        return array('old_password', 'new_password', 'new_password_confirm');
    }
}
