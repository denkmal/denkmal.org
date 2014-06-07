<?php

class Admin_Form_Search extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'searchTerm']));
        $this->registerField(new CM_FormField_Hidden(['name' => 'urlPage']));

        $this->registerAction(new Admin_FormAction_Search_Process($this));
    }

    public function prepare(CM_Frontend_Environment $environment) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        if ($params->has('searchTerm')) {
            $this->getField('searchTerm')->setValue($params->getString('searchTerm'));
        }
        $this->getField('urlPage')->setValue($params->getString('urlPage'));
    }
}
