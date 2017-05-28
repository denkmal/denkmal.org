<?php

class Denkmal_FormField_UrlEventLink extends CM_FormField_Url {

    public function validate(CM_Frontend_Environment $environment, $userInput) {
        $url = parent::validate($environment, $userInput);

        $url = preg_replace('#https?://m\.facebook\.com#', 'https://www.facebook.com', $url);

        return $url;
    }
}
