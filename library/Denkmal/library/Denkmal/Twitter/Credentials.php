<?php

/**
 * @see https://apps.twitter.com/
 */
class Denkmal_Twitter_Credentials implements CM_ArrayConvertible, CM_Comparable {

    /** @var string */
    private $_consumerKey;

    /** @var string */
    private $_consumerSecret;

    /** @var string|null */
    private $_accessToken;

    /** @var string|null */
    private $_accessTokenSecret;

    /**
     * @param string      $consumerKey
     * @param string      $consumerSecret
     * @param string|null $accessToken
     * @param string|null $accessTokenSecret
     */
    public function __construct($consumerKey, $consumerSecret, $accessToken = null, $accessTokenSecret = null) {
        $this->_consumerKey = (string) $consumerKey;
        $this->_consumerSecret = (string) $consumerSecret;
        $this->_accessToken = isset($accessToken) ? (string) $accessToken : null;
        $this->_accessTokenSecret = isset($accessTokenSecret) ? (string) $accessTokenSecret : null;
    }

    /**
     * @return string
     */
    public function getConsumerKey() {
        return $this->_consumerKey;
    }

    /**
     * @return string
     */
    public function getConsumerSecret() {
        return $this->_consumerSecret;
    }

    /**
     * @return string|null
     */
    public function getAccessToken() {
        return $this->_accessToken;
    }

    /**
     * @return string|null
     */
    public function getAccessTokenSecret() {
        return $this->_accessTokenSecret;
    }

    public function toArray() {
        return [
            'consumerKey'       => $this->getConsumerKey(),
            'consumerSecret'    => $this->getConsumerSecret(),
            'accessToken'       => $this->getAccessToken(),
            'accessTokenSecret' => $this->getAccessTokenSecret(),
        ];
    }

    public static function fromArray(array $array) {
        return new self(
            $array['consumerKey'],
            $array['consumerSecret'],
            $array['accessToken'],
            $array['accessTokenSecret']
        );
    }

    /**
     * @param CM_Comparable $other
     * @return boolean
     */
    public function equals(CM_Comparable $other = null) {
        if (null === $other) {
            return false;
        }
        if (!$other instanceof self) {
            return false;
        }
        return $other->toArray() === $this->toArray();
    }

}
