<?php

class Denkmal_Push_ClientConfiguration {

    /** @var array */
    private $_config;

    /**
     * @param array $config
     */
    public function __construct(array $config) {
        $this->_config = $config;
    }

    /**
     * @return string
     */
    public function getGcmSenderId() {
        return (string) $this->_config['gcm_sender_id'];
    }
}
