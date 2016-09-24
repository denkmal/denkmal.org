<?php

class Denkmal_Facebook_AppCredentials implements CM_ArrayConvertible, CM_Comparable {

    /** @var string */
    private $_id;

    /** @var string */
    private $_secret;

    /**
     * @param string $id
     * @param string $secret
     */
    public function __construct($id, $secret) {
        $this->_id = (string) $id;
        $this->_secret = (string) $secret;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getSecret() {
        return $this->_secret;
    }

    public function toArray() {
        return [
            'id'     => $this->getId(),
            'secret' => $this->getSecret(),
        ];
    }

    public static function fromArray(array $array) {
        return new self(
            $array['id'],
            $array['secret']
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
