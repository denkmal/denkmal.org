<?php

class Admin_Form_Region extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Email(['name' => 'emailAddress']));
        $this->registerField(new CM_FormField_Text(['name' => 'facebookAccount']));
        $this->registerField(new Denkmal_FormField_FacebookAppCredentials(['name' => 'facebookAppCredentials']));
        $this->registerField(new Denkmal_FormField_TwitterUsername(['name' => 'twitterAccount']));
        $this->registerField(new Denkmal_FormField_TwitterCredentials(['name' => 'twitterCredentials']));
        $this->registerField(new CM_FormField_Date(['name' => 'suspensionUntil', 'yearFirst' => date('Y'), 'yearLast' => date('Y') + 1]));

        $this->registerAction(new Admin_FormAction_Region_Save($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Params $formParams */
        $formParams = $this->getParams();
        $region = $formParams->getRegion('region');

        $this->getField('emailAddress')->setValue($region->getEmailAddress());
        $this->getField('facebookAccount')->setValue($region->getFacebookAccount());
        $this->getField('facebookAppCredentials')->setValue($region->getFacebookAppCredentials());
        $this->getField('twitterAccount')->setValue($region->getTwitterAccount());
        $this->getField('twitterCredentials')->setValue($region->getTwitterCredentials());
        $this->getField('suspensionUntil')->setValue($region->getSuspension()->getUntil());
    }
}
