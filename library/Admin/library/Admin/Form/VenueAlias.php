<?php

class Admin_Form_VenueAlias extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'venueId']));
        $this->registerField(new CM_FormField_Text(['name' => 'name']));

        $this->registerAction(new Admin_FormAction_VenueAlias_Add($this));
    }

    public function prepare(CM_Frontend_Environment $environment) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        $venue = $params->getVenue('venue');
        $this->getField('venueId')->setValue($venue->getId());
    }
}
