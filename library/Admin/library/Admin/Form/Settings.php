<?php

class Admin_Form_Settings extends CM_Form_Abstract {

    public function setup() {
        $this->registerField('suspensionUntil', new CM_FormField_Date(date('Y'), date('Y') + 1));

        $this->registerAction(new Admin_FormAction_Settings_Save($this));
    }

    protected function _renderStart(CM_Params $params) {
        $site = new Denkmal_Site();
        $this->getField('suspensionUntil')->setValue($site->getSuspension()->getUntil());
    }
}
