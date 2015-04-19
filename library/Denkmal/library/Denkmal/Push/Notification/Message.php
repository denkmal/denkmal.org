<?php

class Denkmal_Push_Notification_Message {

    /** @var int|null */
    private $_ttl;

    /** @var array|null */
    private $_data;

    /**
     * @param int|null   $ttl
     * @param array|null $data
     */
    public function __construct($ttl = null, array $data = null) {
        $this->setTtl($ttl);
        $this->setData($data);
    }

    /**
     * @return int|null
     */
    public function getTtl() {
        return $this->_ttl;
    }

    /**
     * @param int|null $ttl
     */
    public function setTtl($ttl = null) {
        if (null !== $ttl) {
            $ttl = (int) $ttl;
        }
        $this->_ttl = $ttl;
    }

    /**
     * @return array|null
     */
    public function getData() {
        return $this->_data;
    }

    /**
     * @param array|null $data
     */
    public function setData($data = null) {
        if (null !== $data) {
            $data = (array) $data;
        }
        $this->_data = $data;
    }
}
