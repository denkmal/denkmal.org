<?php

class Denkmal_FormField_FacebookPage extends CM_FormField_Text {

    protected function _initialize() {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $this->_options['region'] = $params->getRegion('region');
        parent::_initialize();
    }

    public function validate(\CM_Frontend_Environment $environment, $userInput) {
        $userInput = parent::validate($environment, $userInput);

        $region = $this->_getRegion();
        if ($facebookAppCredentials = $region->getFacebookAppCredentials()) {
            $facebookClient = (new Denkmal_Facebook_ClientFactory())->createClient($facebookAppCredentials);
            $userInput = $this->_getPageId($userInput, $facebookClient);
        }

        if (preg_match('#[^\d]#', $userInput)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Should only contain digits.'));
        }

        return $userInput;
    }

    /**
     * @return Denkmal_Model_Region
     */
    private function _getRegion() {
        return $this->_options['region'];
    }

    /**
     * @param string             $pageUrl
     * @param \Facebook\Facebook $facebookClient
     * @return string
     * @throws CM_Exception_FormFieldValidation
     */
    private function _getPageId($pageUrl, \Facebook\Facebook $facebookClient) {
        try {
            $response = $facebookClient->get('/' . $pageUrl);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Failed to retrieve page ID: ' . $e->getMessage()));
        }
        $pageId = $response->getGraphPage()->getId();
        if (!$pageId) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Failed to retrieve page ID.'));
        }
        return (string) $pageId;
    }
}
