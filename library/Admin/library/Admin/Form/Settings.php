<?php

class Admin_Form_Settings extends CM_Form_Abstract {

    public function setup() {
        $this->registerAction(new Admin_FormAction_Settings_Save($this));
    }

    protected function _renderStart(CM_Params $params) {
    }
}
