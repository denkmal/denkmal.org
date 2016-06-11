<?php

class Admin_Form_Region extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new Denkmal_FormField_TwitterCredentials(['name' => 'twitterCredentials']));
        $this->registerField(new Denkmal_FormField_TwitterUsername(['name' => 'twitterAccount']));
        $this->registerField(new CM_FormField_Text(['name' => 'facebookAccount']));
        $this->registerField(new CM_FormField_Email(['name' => 'emailAddress']));

        $this->registerAction(new Admin_FormAction_Region_Save($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Params $formParams */
        $formParams = $this->getParams();
        $region = $formParams->getRegion('region');

        $this->getField('twitterCredentials')->setValue($region->getTwitterCredentials());
        $this->getField('twitterAccount')->setValue($region->getTwitterAccount());
        $this->getField('facebookAccount')->setValue($region->getFacebookAccount());
        $this->getField('emailAddress')->setValue($region->getEmailAddress());
    }
}
