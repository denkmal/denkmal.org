<?php

class Denkmal_Model_UserInvite extends \CM_Model_Abstract {

    const SALT = 'FAbyviKZecDdk8MWu7wzbGrkt';

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

    /**
     * @return string
     */
    public function getKey() {
        return $this->_get('key');
    }

    /**
     * @param string $key
     */
    public function setKey($key) {
        $this->_set('key', $key);
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'inviter' => array('type' => 'Denkmal_Model_User'),
            'key'     => array('type' => 'string'),
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
        $userInvite->setKey(self::generateKey());
        $userInvite->setEmail($email);
        $userInvite->setExpires($expires);
        $userInvite->commit();

        return $userInvite;
    }

    /**
     * @return string
     */
    public static function generateKey() {
        return md5(rand() . uniqid());
    }

    /**
     * @param string $key
     * @return Denkmal_Model_UserInvite|null
     */
    public static function findByKey($key) {
        $id = CM_Db_Db::select('denkmal_model_userinvite', 'id', ['key' => $key])->fetchColumn();
        if (false === $id) {
            return null;
        }
        return new self($id);
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
