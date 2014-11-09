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

    /**
     * @param string $url
     * @throws CM_Exception_Invalid
     * @return int
     */
    public function getUrlLength($url) {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (false === $scheme) {
            throw new CM_Exception_Invalid('Cannot detect URL scheme for `' . $url . '`.');
        }
        if (null === $scheme) {
            $scheme = 'http';
        }
        $schemeConfigMap = [
            'http'  => 'short_url_length',
            'https' => 'short_url_length_https',
        ];
        if (!array_key_exists($scheme, $schemeConfigMap)) {
            throw new CM_Exception_Invalid('Unexpected URL scheme `' . $scheme . '`.');
        }
        $configKey = $schemeConfigMap[$scheme];
        return (int) $this->getTwitterConfiguration()[$configKey];
    }

    /**
     * @param string $text
     */
    public function createTweet($text) {
        $this->_twitterOauth->post('statuses/update', array(
            'status' => $text,
        ));
    }
}
