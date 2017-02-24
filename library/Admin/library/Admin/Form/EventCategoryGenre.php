<?php

class Admin_Form_EventCategoryGenre extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'genre']));

        $this->registerAction(new Admin_FormAction_EventCategoryGenre_Add($this));
    }

    protected function _getRequiredFields() {
        return ['genre'];
    }

}
