<?php

class Admin_Form_VenueMerge extends CM_Form_Abstract {

    protected function _initialize() {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $venue = $params->getVenue('venue');
        $region = $venue->getRegion();

        $this->registerField(new CM_FormField_Hidden(['name' => 'oldVenue']));
        $this->registerField(new Denkmal_FormField_Venue(['name' => 'newVenue', 'region' => $region, 'enableChoiceCreate' => false]));

        $this->registerAction(new Admin_FormAction_VenueMerge_Merge($this));
    }

    protected function _getRequiredFields() {
        return array('oldVenue', 'newVenue');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $venue = $params->getVenue('venue');

        $this->getField('oldVenue')->setValue($venue->getId());
    }
}
