<?php

class Admin_Form_Settings extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Date(['name' => 'suspensionUntil', 'yearFirst' => date('Y'), 'yearLast' => date('Y') + 1]));
        $this->registerField(new CM_FormField_Boolean(['name' => 'anonymousMessagingDisabled']));

        $this->registerAction(new Admin_FormAction_Settings_Save($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $settings = new Denkmal_App_Settings();
        $this->getField('suspensionUntil')->setValue($settings->getSuspension()->getUntil());
        $this->getField('anonymousMessagingDisabled')->setValue($settings->getAnonymousMessagingDisabled());
    }
}
