<?php

class Admin_Form_Link extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'linkId']));
        $this->registerField(new CM_FormField_Text(['name' => 'label']));
        $this->registerField(new CM_FormField_Url(['name' => 'url']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'automatic']));

        $this->registerAction(new Admin_FormAction_Link_Add($this));
        $this->registerAction(new Admin_FormAction_Link_Save($this));
        $this->registerAction(new Admin_FormAction_Link_Delete($this));
    }

    public function prepare(CM_Params $renderParams) {
        /** @var Denkmal_Params $renderParams */
        if ($renderParams->has('link')) {
            $link = $renderParams->getLink('link');
            $this->getField('linkId')->setValue($link->getId());
            $this->getField('label')->setValue($link->getLabel());
            $this->getField('url')->setValue($link->getUrl());
            $this->getField('automatic')->setValue($link->getAutomatic());
        } else {
            $this->getField('automatic')->setValue(true);
        }
    }
}
