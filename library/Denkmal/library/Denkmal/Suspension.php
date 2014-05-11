<?php

class Denkmal_Suspension extends CM_Class_Abstract {

    /** @var Denkmal_Site */
    private $_site;

    /**
     * @param Denkmal_Site $site
     */
    public function __construct(Denkmal_Site $site) {
        $this->_site = $site;
    }

    /**
     * @return DateTime|null
     */
    public function getUntil() {
        return CM_Option::getInstance()->get('denkmal.suspension.until');
    }

    /**
     * @param DateTime|null $until
     */
    public function setUntil(DateTime $until = null) {
        CM_Option::getInstance()->set('denkmal.suspension.until', $until);
    }

    /**
     * @return bool
     */
    public function isActive() {
        $now = new DateTime();
        $until = $this->getUntil();
        return $until && $until > $now;
    }
}
