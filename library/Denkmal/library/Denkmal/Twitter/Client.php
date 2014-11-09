<?php

class Denkmal_Twitter_Client extends CM_Service_ManagerAware {

    /** @var TwitterOAuth\TwitterOAuth */
    private $_twitterOauth;

    /**
     * @param array $config
     */
    public function __construct(array $config) {
        $config = array_merge($config, array(
            'output_format' => 'array',
        ));
        $this->_twitterOauth = new TwitterOAuth\TwitterOAuth($config);
    }

    /**
     * @return array
     */
    public function getTwitterConfiguration() {
        $cache = CM_Cache_Shared::getInstance();
        $cacheKey = __CLASS__ . '_configuration';
        if (false === ($configuration = $cache->get($cacheKey))) {
            $configuration = $this->_twitterOauth->get('help/configuration');
            $cache->set($cacheKey, $configuration, 86400);
        }
        return $configuration;
    }
}
