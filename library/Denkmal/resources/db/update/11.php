<?php

$language = CM_Model_Language::findByAbbreviation('de');
$language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
$language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');
$language->setTranslation('.internals.role.' . Denkmal_Role::HIPSTER, 'Denkmal Hipster');
