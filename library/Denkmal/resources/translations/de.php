<?php

return function (CM_Model_Language $language) {
    $language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
    $language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');
    $language->setTranslation('.internals.role.' . Denkmal_Role::HIPSTER, 'Denkmal Hipster');
};
