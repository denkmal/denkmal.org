<?php

$language = CM_Model_Language::findByAbbreviation('de');
$language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
$language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');
$language->setTranslation('.internals.role.' . Denkmal_Role::HIPSTER, 'Denkmal Hipster');

if ($userFrederick = Denkmal_Model_User::findByEmail('fred.jan.duerr@gmail.com')) {
    $userFrederick->getRoles()->delete(Denkmal_Role::ADMIN);
    $userFrederick->getRoles()->add(Denkmal_Role::PUBLISHER);
}
