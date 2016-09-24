<?php

class Denkmal_FormField_FacebookAppCredentials extends CM_FormField_Abstract {

    /**
     * @param CM_Frontend_Environment $environment
     * @param string[]                $userInput
     * @return Denkmal_Twitter_Credentials
     * @throws CM_Exception_FormFieldValidation
     */
    public function validate(CM_Frontend_Environment $environment, $userInput) {
        $id = $userInput['id'];
        $secret = $userInput['secret'];

        if (empty($id) || empty($secret)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Missing "id" and "secret".'));
        }

        return new Denkmal_Facebook_AppCredentials($id, $secret);
    }

    public function prepare(CM_Params $renderParams, CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Facebook_AppCredentials|null $value */
        $value = $this->getValue();

        $viewResponse->set('id', $value ? $value->getId() : null);
        $viewResponse->set('secret', $value ? $value->getSecret() : null);
    }

    public function isEmpty($userInput) {
        return empty($userInput['id']) && empty($userInput['secret']);
    }
}
