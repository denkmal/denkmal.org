<?php

class Denkmal_Suspension extends CM_Class_Abstract {

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
