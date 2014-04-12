<?php

class Admin_Form_Login extends CM_Form_Abstract {

    public function setup() {
        $this->registerField('email', new CM_FormField_Email());
        $this->registerField('password', new CM_FormField_Password());

        $this->registerAction(new Admin_FormAction_Login_Process($this));
    }
}
