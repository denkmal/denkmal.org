<?php

class Denkmal_App_Auth {

    /**
     * @param Denkmal_Model_User $user
     * @param string             $password
     * @return string
     */
    public static function generateHashUserPassword(Denkmal_Model_User $user, $password) {
        return self::_generateHash($password . ':' . $user->getId(), '6t9q58679grt34078nhuwefpwipneklhmjktikz8itseydxaxyoi827b5f8i2d324deagstzujj');
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool|Denkmal_Model_User
     */
    public static function checkLogin($login, $password) {
        $query = 'SELECT `userId`  FROM `denkmal_model_user` WHERE `email` = ? OR `username` = ?';
        $userId = CM_Db_Db::exec($query, array($login, $login))->fetchColumn();
        if (!$userId) {
            return false;
        }
        $user = new Denkmal_Model_User($userId);
        $hash = self::generateHashUserPassword($user, $password);
        $hashMatchesProfile = CM_Db_Db::count('denkmal_model_user', array('userId' => $userId, 'password' => $hash));
        if (!$hashMatchesProfile) {
            return false;
        }
        return $user;
    }

    /**
     * @param string $base
     * @param string $salt
     * @return string
     */
    private static function _generateHash($base, $salt) {
        $hash = hash('sha256', $salt . ':' . $base);
        return $hash;
    }
}
