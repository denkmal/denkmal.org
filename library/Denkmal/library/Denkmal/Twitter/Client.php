<?php

class Denkmal_Twitter_Client extends CM_Service_ManagerAware {

    /** @var TwitterOAuth\Auth\SingleUserAuth */
    private $_twitterOauth;

    /**
     * @param Denkmal_Twitter_Credentials $credentials
     */
    public function __construct(Denkmal_Twitter_Credentials $credentials) {
        $this->_twitterOauth = new TwitterOAuth\Auth\SingleUserAuth([
            'consumer_key'       => $credentials->getConsumerKey(),
            'consumer_secret'    => $credentials->getConsumerSecret(),
            'oauth_token'        => $credentials->getAccessToken(),
            'oauth_token_secret' => $credentials->getAccessTokenSecret(),
        ], new TwitterOAuth\Serializer\ArraySerializer());
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
            throw new CM_Exception_Invalid('Cannot detect URL scheme.', null, ['url' => $url]);
        }
        if (null === $scheme) {
            $scheme = 'http';
        }
        $schemeConfigMap = [
            'http'  => 'short_url_length',
            'https' => 'short_url_length_https',
        ];
        if (!array_key_exists($scheme, $schemeConfigMap)) {
            throw new CM_Exception_Invalid('Unexpected URL scheme.', null, ['url' => $url, 'scheme' => $scheme]);
        }
        $configKey = $schemeConfigMap[$scheme];
        return (int) $this->getTwitterConfiguration()[$configKey];
    }

    /**
     * @param string $text
     * @return int
     */
    public function getTweetLength($text) {
        $length = mb_strlen($text);

        $extractor = new Twitter_Extractor($text);
        foreach ($extractor->extractURLs() as $url) {
            $length -= mb_strlen($url);
            $length += $this->getUrlLength($url);
        }

        return $length;
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
