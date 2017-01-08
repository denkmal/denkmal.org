<?php

class Admin_Form_Venue extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'name']));
        $this->registerField(new CM_FormField_Url(['name' => 'url']));
        $this->registerField(new CM_FormField_Text(['name' => 'address']));
        $this->registerField(new CM_FormField_Email(['name' => 'email']));
        $this->registerField(new Denkmal_FormField_TwitterUsername(['name' => 'twitterUsername']));
        $this->registerField(new Denkmal_FormField_FacebookPage(['name' => 'facebookPage']));
        $this->registerField(new CM_FormField_GeoPoint(['name' => 'coordinates']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'ignore']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'suspended']));
        $this->registerField(new CM_FormField_Boolean(['name' => 'secret']));

        $this->registerAction(new Admin_FormAction_Venue_Save($this));
    }

    protected function _getRequiredFields() {
        return array('name');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $venue = $params->getVenue('venue');

        $this->getField('name')->setValue($venue->getName());
        $this->getField('url')->setValue($venue->getUrl());
        $this->getField('address')->setValue($venue->getAddress());
        $this->getField('email')->setValue($venue->getEmail());
        $this->getField('twitterUsername')->setValue($venue->getTwitterUsername());
        $this->getField('facebookPage')->setValue($venue->getFacebookPage());
        $this->getField('coordinates')->setValue($venue->getCoordinates());
        $this->getField('ignore')->setValue($venue->getIgnore());
        $this->getField('suspended')->setValue($venue->getSuspended());
        $this->getField('secret')->setValue($venue->getSecret());
    }

    public function ajax_deleteVenue(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $venue = $params->getVenue('venue');

        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            throw new CM_Exception_NotAllowed();
        }

        $venue->delete();
    }

}
