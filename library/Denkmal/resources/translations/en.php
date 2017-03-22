<?php

return function (CM_Model_Language $language) {
    $language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
    $language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');

    $language->setTranslation('.meta.description', '{$siteName} is an event calendar made by locals. Explore your city\'s nightlife and never miss a great party again.');
    $language->setTranslation('.meta.description.basel', 'Basel\'s event calendar made by locals. Explore Basel\'s nightlife and never miss a great party again.');
    $language->setTranslation('.meta.description.graz', 'Graz\' event calendar made by locals. Explore Graz\' nightlife and never miss a great party again.');
};
