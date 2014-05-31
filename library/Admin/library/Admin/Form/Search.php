<?php

class Admin_Form_Search extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'searchTerm']));
        $this->registerField(new CM_FormField_Hidden(['name' => 'urlPage']));

        $this->registerAction(new Admin_FormAction_Search_Process($this));
    }

    public function prepare(CM_Params $renderParams) {
        /** @var Denkmal_Params $renderParams */
        if ($renderParams->has('searchTerm')) {
            $this->getField('searchTerm')->setValue($renderParams->getString('searchTerm'));
        }
        $this->getField('urlPage')->setValue($renderParams->getString('urlPage'));
    }
}
