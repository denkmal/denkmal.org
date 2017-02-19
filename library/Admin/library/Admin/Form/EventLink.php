<?php

class Admin_Form_EventLink extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'label']));
        $this->registerField(new CM_FormField_Url(['name' => 'url']));

        $this->registerAction(new Admin_FormAction_EventLink_Add($this));
    }

    protected function _getRequiredFields() {
        return ['label', 'url'];
    }

}
