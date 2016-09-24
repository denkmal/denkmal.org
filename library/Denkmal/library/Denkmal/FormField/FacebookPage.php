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
        $facebookAppCredentials = $region->getFacebookAppCredentials();

        if (preg_match('#^http#', $userInput) && $facebookAppCredentials) {
            $facebook = (new Denkmal_Facebook_ClientFactory())->createClient($facebookAppCredentials);
            $response = $facebook->get('/' . $userInput);
            if ($pageId = $response->getGraphPage()->getId()) {
                $userInput = $pageId;
            }
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
}
