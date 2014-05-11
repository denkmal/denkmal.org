<?php

class Denkmal_Suspension extends CM_Class_Abstract {

    /**
     * @return DateTime|null
     */
    public function getUntil() {
        return CM_Option::getInstance()->get('suspendedUntil');
    }

    /**
     * @param DateTime|null $until
     */
    public function setUntil(DateTime $until = null) {
        CM_Option::getInstance()->set('suspendedUntil', $until);
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
