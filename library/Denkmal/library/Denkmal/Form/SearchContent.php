<?php

class Denkmal_Form_SearchContent extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'term']));
        //		$this->registerAction(new Denkmal_FormAction_SearchContent_Search($this));
    }
}
