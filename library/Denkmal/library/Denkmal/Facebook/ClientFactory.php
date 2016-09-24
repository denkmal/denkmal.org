<?php

class Denkmal_Facebook_ClientFactory {

    /**
     * @param Denkmal_Facebook_AppCredentials $appCredentials
     * @return \Facebook\Facebook
     */
    public function createClient(Denkmal_Facebook_AppCredentials $appCredentials) {
        $accessToken = $appCredentials->getId() . '|' . $appCredentials->getSecret();
        $client = new \Facebook\Facebook([
            'app_id'                => $appCredentials->getId(),
            'app_secret'            => $appCredentials->getSecret(),
            'default_graph_version' => 'v2.7',
            'default_access_token'  => $accessToken,
        ]);
        return $client;
    }

}
