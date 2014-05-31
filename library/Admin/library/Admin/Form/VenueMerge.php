<?php

class Admin_Form_VenueMerge extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'oldVenue']));
        $this->registerField(new Denkmal_FormField_Venue(['name' => 'newVenue', 'enableChoiceCreate' => false]));

        $this->registerAction(new Admin_FormAction_Venue_Merge($this));
    }

    protected function _renderStart(CM_Params $params) {
        /** @var Denkmal_Params $params */
        $venue = $params->getVenue('venue');

        $this->getField('oldVenue')->setValue($venue->getId());
    }
}
