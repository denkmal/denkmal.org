<?php

if (!CM_Db_Db::existsColumn('denkmal_model_user', 'username')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_user ADD COLUMN `username` VARCHAR(32) NOT NULL AFTER `email`");

    $userIdList = CM_Db_Db::select('denkmal_model_user', 'userId')->fetchAllColumn();
    foreach ($userIdList as $userId) {
        $user = new Denkmal_Model_User($userId);
        if (preg_match('#^(?<username>.+)@#', $user->getEmail(), $matches)) {
            $user->setUsername($matches['username']);
        }
    }
}
