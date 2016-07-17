<?php

class Denkmal_Suspension extends CM_Class_Abstract {
    
    /** @var DateTime|null */
    private $_until;

    /**
     * @param DateTime|null $until
     */
    public function __construct(DateTime $until = null) {
        $this->_until = $until;
    }

    /**
     * @return DateTime|null
     */
    public function getUntil() {
        return $this->_until;
    }

    /**
     * @return bool
     */
    public function isActive() {
        $now = new DateTime();
        $until = $this->getUntil();
        return $until && $until > $now;
    }

    /**
     * @return int
     */
    public function getDaysLeft() {
        $now = new DateTime();
        $until = $this->getUntil();
        $daysLeft = 0;
        if ($until && $until > $now) {
            $daysLeft = $now->diff($until)->days + 1;
        }
        return $daysLeft;
    }
}
