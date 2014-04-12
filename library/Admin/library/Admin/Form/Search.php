<?php

class Admin_Form_Search extends CM_Form_Abstract {

    public function setup() {
        $this->registerField('searchTerm', new CM_FormField_Text());
        $this->registerField('urlPage', new CM_FormField_Hidden());

        $this->registerAction(new Admin_FormAction_Search_Process($this));
    }

    protected function _renderStart(CM_Params $params) {
        /** @var Denkmal_Params $params */
        if ($params->has('searchTerm')) {
            $this->getField('searchTerm')->setValue($params->getString('searchTerm'));
        }
        $this->getField('urlPage')->setValue($params->getString('urlPage'));
    }
}
