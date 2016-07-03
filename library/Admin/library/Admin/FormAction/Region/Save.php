<?php

class Admin_FormAction_Region_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return ['emailAddress'];
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Site_Default $site */
        $site = $response->getSite();

        /** @var Denkmal_Twitter_Credentials|null $twitterCredentials */
        $emailAddress = $params->getString('emailAddress');
        $facebookAccount = $params->has('facebookAccount') ? $params->getString('facebookAccount') : null;
        $twitterAccount = $params->has('twitterAccount') ? $params->getString('twitterAccount') : null;
        $twitterCredentials = $params->has('twitterCredentials') ? $params->getObject('twitterCredentials', 'Denkmal_Twitter_Credentials') : null;
        $suspensionUntil = $params->has('suspensionUntil') ? $params->getDateTime('suspensionUntil') : null;

        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $region = $formParams->getRegion('region');
        $region->setEmailAddress($emailAddress);
        $region->setFacebookAccount($facebookAccount);
        $region->setTwitterAccount($twitterAccount);
        $region->setTwitterCredentials($twitterCredentials);
        $region->setSuspension($suspensionUntil);

        if ($site->hasRegion()) {
            $site->getRegion()->_change();
        }
        $response->reloadComponent();
    }

}
