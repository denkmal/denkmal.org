<?php

class Admin_Form_FacebookPageList extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new Denkmal_FormField_FacebookPage(['name' => 'facebookPage']));

        $this->registerAction(new Admin_FormAction_FacebookPageList_Add($this));
    }
}
