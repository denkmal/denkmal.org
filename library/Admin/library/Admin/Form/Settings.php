<?php

class Admin_Form_Settings extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Date(['name' => 'suspensionUntil', 'yearFirst' => date('Y'), 'yearLast' => date('Y') + 1]));

        $this->registerAction(new Admin_FormAction_Settings_Save($this));
    }

    protected function _renderStart(CM_Params $params) {
        $site = new Denkmal_Site();
        $this->getField('suspensionUntil')->setValue($site->getSuspension()->getUntil());
    }
}
