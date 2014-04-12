<?php

class Admin_Form_Link extends CM_Form_Abstract {

    public function setup() {
        $this->registerField('linkId', new CM_FormField_Hidden());
        $this->registerField('label', new CM_FormField_Text());
        $this->registerField('url', new CM_FormField_Url());
        $this->registerField('automatic', new CM_FormField_Boolean());

        $this->registerAction(new Admin_FormAction_Link_Add($this));
        $this->registerAction(new Admin_FormAction_Link_Save($this));
        $this->registerAction(new Admin_FormAction_Link_Delete($this));
    }

    protected function _renderStart(CM_Params $params) {
        /** @var Denkmal_Params $params */
        if ($params->has('link')) {
            $link = $params->getLink('link');
            $this->getField('linkId')->setValue($link->getId());
            $this->getField('label')->setValue($link->getLabel());
            $this->getField('url')->setValue($link->getUrl());
            $this->getField('automatic')->setValue($link->getAutomatic());
        } else {
            $this->getField('automatic')->setValue(true);
        }
    }
}
