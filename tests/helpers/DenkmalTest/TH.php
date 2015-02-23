<?php

class DenkmalTest_TH extends CMTest_TH {

    /**
     * @param string|null $email
     * @param string|null $username
     * @return Denkmal_Model_User
     */
    public static function createUser($email = null, $username = null) {
        if (is_null($username)) {
            while (empty($username) || Denkmal_Model_User::findByUsername($username)) {
                $username .= self::randStr(2);
            }
        }
        $fields = array();
        $fields['password'] = md5(rand() . uniqid());
        $fields['username'] = (string) $username;
        $fields['email'] = $fields['username'] . '@example.com';
        return Denkmal_Model_User::createStatic($fields);
    }

    /**
     * @return Denkmal_Model_User
     */
    public static function createUserHipster() {
        $user = self::createUser();
        $user->getRoles()->add(Denkmal_Role::HIPSTER, 1000 * 86400);
        return $user;
    }

    /**
     * @return Denkmal_Model_User
     */
    public static function createUserAdmin() {
        $user = self::createUser();
        $user->getRoles()->add(Denkmal_Role::ADMIN);
        return $user;
    }

    /**
     * @param int    $length
     * @param string $charset
     * @return string
     */
    public static function randStr($length, $charset = 'abcdefghijklmnopqrstuvwxyz0123456789') {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }
}
