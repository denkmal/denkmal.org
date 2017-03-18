<?php

return function (CM_Model_Language $language) {
    $language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
    $language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');

    $language->setTranslation('.meta.description', '{$siteName} is an event calendar by locals. Explore your city\'s nightlife and get event updates and impressions by the crowd in real-time.');
    $language->setTranslation('.meta.description.basel', 'Basel\'s event calendar made and curated by locals. We help you explore Basel\'s nightlife and make sure you never miss a great party again!');
    $language->setTranslation('.meta.description.graz', 'Graz\' event calendar made and curated by locals. We help you explore Graz\' nightlife and make sure you never miss a great party again!');
};
