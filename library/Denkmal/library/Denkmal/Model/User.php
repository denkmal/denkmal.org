<?php

class Denkmal_Model_User extends CM_Model_User {

    /**
     * @return string
     */
    public function getEmail() {
        return $this->_get('email');
    }

    /**
     * @param string $email
     * @return Denkmal_Model_User
     */
    public function setEmail($email) {
        CM_Db_Db::update('denkmal_model_user', array('email' => $email), array('userId' => $this->getId()));
        $this->_change();
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->_get('username');
    }

    /**
     * @param string $username
     * @return Denkmal_Model_User
     */
    public function setUsername($username) {
        CM_Db_Db::update('denkmal_model_user', array('username' => $username), array('userId' => $this->getId()));
        $this->_change();
    }

    /**
     * @param string $password
     * @return Denkmal_Model_User
     */
    public function setPassword($password) {
        $hash = Denkmal_App_Auth::generateHashUserPassword($this, $password);
        CM_Db_Db::update('denkmal_model_user', array('password' => $hash), array('userId' => $this->getId()));
        return $this->_change();
    }

    public function getDisplayName() {
        return $this->getUsername();
    }

    protected function _loadData() {
        $return = CM_Db_Db::exec("SELECT `main`.*, `secondary`.*, `online`.`userId` AS `online`, `online`.`visible`
								  FROM `cm_user` AS `main`
								  JOIN `denkmal_model_user` AS `secondary` USING (`userId`)
								  LEFT JOIN `cm_user_online` AS `online` USING(`userId`)
								  WHERE `main`.`userId`=?", array($this->getId()))->fetch();
        return $return;
    }

    /**
     * @param string $email
     * @param string $password
     * @return Denkmal_Model_User
     * @throws CM_Exception_AuthFailed
     */
    public static function authenticate($email, $password) {
        if (!$email || !$password) {
            throw new CM_Exception_AuthFailed('E-Mail und Passwort benötigt', null, array(
                'messagePublic' => 'E-Mail oder Password ist nicht gesetzt.',
            ));
        }
        $user = Denkmal_App_Auth::checkLogin($email, $password);
        if (!$user) {
            throw new CM_Exception_AuthFailed('Login fehlgeschlagen', null, array(
                'messagePublic' => 'E-Mail oder Passwort ist falsch.',
            ));
        }

        return $user;
    }

    /**
     * @param string $email
     * @param string $username
     * @param string $password
     * @return Denkmal_Model_User
     */
    public static function create($email, $username, $password) {
        return static::createStatic(array(
            'email'    => $email,
            'username' => $username,
            'password' => $password,
        ));
    }

    /**
     * @param string $email
     * @return Denkmal_Model_User|null
     */
    public static function findByEmail($email) {
        $id = CM_Db_Db::select('denkmal_model_user', 'userId', array('email' => $email))->fetchColumn();
        if (!$id) {
            return null;
        }
        return new self($id);
    }

    /**
     * @param string $username
     * @return Denkmal_Model_User|null
     */
    public static function findByUsername($username) {
        $id = CM_Db_Db::select('denkmal_model_user', 'userId', array('username' => $username))->fetchColumn();
        if (!$id) {
            return null;
        }
        return new self($id);
    }

    /**
     * @param array $data
     * @throws CM_Exception|Exception
     * @return Denkmal_Model_User
     */
    protected static function _createStatic(array $data) {
        $email = (string) $data['email'];
        $username = (string) $data['username'];
        $password = (string) $data['password'];
        $userId = CM_Model_User::createStatic(null)->getId();
        $values = array(
            'userId'   => $userId,
            'email'    => $email,
            'username' => $username,
        );
        try {
            CM_Db_Db::insert('denkmal_model_user', $values);
        } catch (CM_Exception $e) {
            CM_Db_Db::delete('cm_user', array('userId' => $userId));
            throw $e;
        }

        $user = new self($userId);
        $user->setPassword($password);

        return $user;
    }
}
