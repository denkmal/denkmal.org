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
        /** @var Denkmal_Twitter_Credentials|null $twitterCredentials */
        $twitterCredentials = $params->has('twitterCredentials') ? $params->getObject('twitterCredentials', 'Denkmal_Twitter_Credentials') : null;
        $twitterAccount = $params->has('twitterAccount') ? $params->getString('twitterAccount') : null;
        $facebookAccount = $params->has('facebookAccount') ? $params->getString('facebookAccount') : null;
        $emailAddress = $params->getString('emailAddress');

        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $region = $formParams->getRegion('region');
        $region->setTwitterCredentials($twitterCredentials);
        $region->setTwitterAccount($twitterAccount);
        $region->setFacebookAccount($facebookAccount);
        $region->setEmailAddress($emailAddress);
    }

}
