<?php

class Admin_Form_Event extends CM_Form_Abstract {

    protected function _initialize() {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $event = $params->getEvent('event');
        $region = $event->getVenue()->getRegion();
        $timeZone = $event->getTimeZone();

        $this->registerField(new Denkmal_FormField_Venue(['name' => 'venue', 'region' => $region, 'enableChoiceCreate' => false]));
        $this->registerField(new CM_FormField_Date(['name'      => 'date', 'timeZone' => $timeZone,
                                                    'yearFirst' => date('Y') - 1, 'yearLast' => (int) date('Y') + 1]));
        $this->registerField(new CM_FormField_Time(['name' => 'fromTime', 'timeZone' => $timeZone]));
        $this->registerField(new CM_FormField_Time(['name' => 'untilTime', 'timeZone' => $timeZone]));
        $this->registerField(new CM_FormField_Textarea(['name' => 'description']));
        $this->registerField(new Denkmal_FormField_Song(['name' => 'song']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'starred']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'hidden']));

        $this->registerAction(new Admin_FormAction_Event_Save($this));
        $this->registerAction(new Admin_FormAction_Event_Preview($this));
    }

    protected function _getRequiredFields() {
        return array('venue', 'date', 'fromTime', 'description');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $event = $params->getEvent('event');

        $this->getField('venue')->setValue($event->getVenue());
        $this->getField('date')->setValue($event->getFrom());
        $this->getField('fromTime')->setValue($event->getFrom());
        $this->getField('untilTime')->setValue($event->getUntil());
        $this->getField('description')->setValue($event->getDescription());
        $this->getField('song')->setValue($event->getSong());
        $this->getField('starred')->setValue($event->getStarred());
        $this->getField('hidden')->setValue($event->getHidden());
    }

    public function ajax_deleteEvent(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            throw new CM_Exception_NotAllowed();
        }

        $event = $params->getEvent('event');
        $event->delete();
    }

}
