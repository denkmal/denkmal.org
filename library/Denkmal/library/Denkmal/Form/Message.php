<?php

class Denkmal_Form_Message extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new Denkmal_FormField_VenueNearby(['name' => 'venue']));
        $this->registerField(new CM_FormField_Text(['name' => 'text', 'lengthMax' => 500]));
        $this->registerField(new CM_FormField_FileImage(['name' => 'image']));
        $this->registerField(new Denkmal_FormField_Tags(['name' => 'tags', 'cardinality' => 3]));

        $this->registerAction(new Denkmal_FormAction_Message_Create($this));
    }
}
