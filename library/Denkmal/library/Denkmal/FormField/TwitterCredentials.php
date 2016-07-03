<?php

class Denkmal_FormField_TwitterCredentials extends CM_FormField_Abstract {

    /**
     * @param CM_Frontend_Environment $environment
     * @param string[]                $userInput
     * @return Denkmal_Twitter_Credentials
     * @throws CM_Exception_FormFieldValidation
     */
    public function validate(CM_Frontend_Environment $environment, $userInput) {
        $consumerKey = $userInput['consumerKey'];
        $consumerSecret = $userInput['consumerSecret'];
        $accessToken = $userInput['accessToken'];
        $accessTokenSecret = $userInput['accessTokenSecret'];

        if (empty($consumerKey) || empty($consumerSecret)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Missing "consumer key" and "consumer secret".'));
        }

        return new Denkmal_Twitter_Credentials($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    }

    public function prepare(CM_Params $renderParams, CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Twitter_Credentials|null $value */
        $value = $this->getValue();

        $viewResponse->set('consumerKey', $value ? $value->getConsumerKey() : null);
        $viewResponse->set('consumerSecret', $value ? $value->getConsumerSecret() : null);
        $viewResponse->set('accessToken', $value ? $value->getAccessToken() : null);
        $viewResponse->set('accessTokenSecret', $value ? $value->getAccessTokenSecret() : null);
    }

    public function isEmpty($userInput) {
        return empty($userInput['consumerKey']) && empty($userInput['consumerSecret']);
    }

}
