<?php

class Admin_Form_UserInvite extends \CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Email(['name' => 'email']));
        $this->registerField(new CM_FormField_Date(['name' => 'expires']));

        $this->registerAction(new Admin_FormAction_UserInvite_Create($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $this->getField('expires')->setValue((new DateTime())->modify('+30 days'));
    }
}
