<?php

class Admin_Form_Event extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'eventId']));
        $this->registerField(new Denkmal_FormField_Venue(['name' => 'venue', 'enableChoiceCreate' => false]));
        $this->registerField(new CM_FormField_Date(['name' => 'date', 'yearFirst' => date('Y') - 1, 'yearLast' => (int) date('Y') + 1]));
        $this->registerField(new Denkmal_FormField_Time(['name' => 'fromTime']));
        $this->registerField(new Denkmal_FormField_Time(['name' => 'untilTime']));
        $this->registerField(new CM_FormField_Textarea(['name' => 'description']));
        $this->registerField(new Denkmal_FormField_Song(['name' => 'song']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'starred']));

        $this->registerAction(new Admin_FormAction_Event_Save($this));
        $this->registerAction(new Admin_FormAction_Event_Save_Preview($this));
        $this->registerAction(new Admin_FormAction_Event_Delete($this));
        $this->registerAction(new Admin_FormAction_Event_Show($this));
        $this->registerAction(new Admin_FormAction_Event_Hide($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $event = $params->getEvent('event');

        $this->getField('eventId')->setValue($event->getId());
        $this->getField('venue')->setValue($event->getVenue());
        $this->getField('date')->setValue($event->getFrom());
        $this->getField('fromTime')->setValue($event->getFrom());
        $this->getField('untilTime')->setValue($event->getUntil());
        $this->getField('description')->setValue($event->getDescription());
        $this->getField('song')->setValue($event->getSong());
        $this->getField('starred')->setValue($event->getStarred());
    }
}
