<?php

class Denkmal_Facebook_RequestWithoutApp extends \Facebook\FacebookRequest {

    public function getAppSecretProof() {
        return null;
    }

}
