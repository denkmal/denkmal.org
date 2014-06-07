<?php

class Admin_Form_VenueMerge extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'oldVenue']));
        $this->registerField(new Denkmal_FormField_Venue(['name' => 'newVenue', 'enableChoiceCreate' => false]));

        $this->registerAction(new Admin_FormAction_Venue_Merge($this));
    }

    public function prepare(CM_Frontend_Environment $environment) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        $venue = $params->getVenue('venue');
        $this->getField('oldVenue')->setValue($venue->getId());
    }
}
