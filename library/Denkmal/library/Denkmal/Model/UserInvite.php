<?php

class Denkmal_Model_UserInvite extends \CM_Model_Abstract {

    /**
     * @return Denkmal_Model_User
     */
    public function getInviter() {
        return $this->_get('inviter');
    }

    /**
     * @param Denkmal_Model_User $inviter
     */
    public function setInviter(Denkmal_Model_User $inviter) {
        $this->_set('inviter', $inviter);
    }

    /**
     * @return string|null
     */
    public function getEmail() {
        return $this->_get('email');
    }

    /**
     * @param string|null $email
     */
    public function setEmail($email = null) {
        $this->_set('email', $email);
    }

    /**
     * @return DateTime|null
     */
    public function getExpires() {
        return $this->_get('expires');
    }

    /**
     * @param DateTime|null $expires
     */
    public function setExpires($expires = null) {
        $this->_set('expires', $expires);
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'inviter' => array('type' => 'Denkmal_Model_User'),
            'email'   => array('type' => 'string', 'optional' => true),
            'expires' => array('type' => 'DateTime', 'optional' => true),
        ));
    }

    /**
     * @param Denkmal_Model_User $inviter
     * @param string|null        $email
     * @param DateTime|null      $expires
     * @return Denkmal_Model_UserInvite
     */
    public static function create(Denkmal_Model_User $inviter, $email = null, DateTime $expires = null) {
        $userInvite = new self();
        $userInvite->setInviter($inviter);
        $userInvite->setEmail($email);
        $userInvite->setExpires($expires);
        $userInvite->commit();

        return $userInvite;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
