<?php

class Admin_Form_Venue extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'venueId']));
        $this->registerField(new CM_FormField_Text(['name' => 'name']));
        $this->registerField(new CM_FormField_Url(['name' => 'url']));
        $this->registerField(new CM_FormField_Text(['name' => 'address']));
        $this->registerField(new CM_FormField_Email(['name' => 'email']));
        $this->registerField(new CM_FormField_GeoPoint(['name' => 'coordinates']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'ignore']));

        $this->registerAction(new Admin_FormAction_Venue_Save($this));
        $this->registerAction(new Admin_FormAction_Venue_Delete($this));
    }

    public function prepare(CM_Frontend_Environment $environment) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        $venue = $params->getVenue('venue');
        $this->getField('venueId')->setValue($venue->getId());
        $this->getField('name')->setValue($venue->getName());
        $this->getField('url')->setValue($venue->getUrl());
        $this->getField('address')->setValue($venue->getAddress());
        $this->getField('email')->setValue($venue->getEmail());
        $this->getField('coordinates')->setValue($venue->getCoordinates());
        $this->getField('ignore')->setValue($venue->getIgnore());
    }
}
