<?php

class Denkmal_Model_User extends CM_Model_User {

	const TYPE = 106;

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

	protected function _loadData() {
		$return = CM_Db_Db::exec("SELECT `main`.*, `secondary`.*, `online`.`userId` AS `online`, `online`.`visible`
								  FROM `cm_user` AS `main`
								  JOIN `denkmal_model_user` AS `secondary` USING (`userId`)
								  LEFT JOIN `cm_user_online` AS `online` USING(`userId`)
								  WHERE `main`.`userId`=?", array($this->getId()))->fetch();
		return $return;
	}

	/**
	 * @param string $login
	 * @param string $password
	 * @return Denkmal_Model_User
	 * @throws CM_Exception_AuthFailed
	 */
	public static function authenticate($login, $password) {
		if (!$login || !$password) {
			throw new CM_Exception_AuthFailed('Username and password required', 'Username or Password is empty');
		}
		$user = Denkmal_App_Auth::checkLogin($login, $password);
		if (!$user) {
			throw new CM_Exception_AuthFailed('Authentication failed', 'Password and Username do not match');
		}

		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$user->getUseragents()->add($_SERVER['HTTP_USER_AGENT']);
		}
		return $user;
	}

	/**
	 * @param array $data
	 * @throws CM_Exception|Exception
	 * @return Denkmal_Model_User
	 */
	public static function _createStatic(array $data) {
		$username = (string) $data['username'];
		$password = (string) $data['password'];
		$userId = CM_Model_User::createStatic(null)->getId();
		$values = array('userId' => $userId, 'username' => $username,);
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
