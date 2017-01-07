<?php

class Admin_Form_VenueAlias extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'venueId']));
        $this->registerField(new CM_FormField_Text(['name' => 'name']));

        $this->registerAction(new Admin_FormAction_VenueAlias_Add($this));
    }

    protected function _getRequiredFields() {
        return array('name');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        $venue = $params->getVenue('venue');
        $this->getField('venueId')->setValue($venue->getId());
    }
}
