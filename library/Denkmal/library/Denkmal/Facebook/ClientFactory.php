<?php

class Denkmal_Facebook_ClientFactory {

    /**
     * @param string $appId
     * @param string $appSecret
     * @return \Facebook\Facebook
     */
    public function createClient($appId, $appSecret) {
        $accessToken = $appId . '|' . $appSecret;
        $client = new \Facebook\Facebook([
            'app_id'                => $appId,
            'app_secret'            => $appSecret,
            'default_graph_version' => 'v2.7',
            'default_access_token'  => $accessToken,
        ]);
        return $client;
    }

}
