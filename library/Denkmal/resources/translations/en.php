<?php

return function (CM_Model_Language $language) {
    $language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
    $language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');

    $language->setTranslation('.meta.description', '{$siteName} is an event calendar by locals. Explore your city\'s nightlife and get event updates and impressions by the crowd in real-time.');
    $language->setTranslation('.meta.description.basel', 'Basel\'s event calendar by locals. Explore Basel\'s nightlife and get event updates and impressions by the crowd in real-time.');
    $language->setTranslation('.meta.description.graz', 'Graz\' event calendar by locals. Explore Graz\' nightlife and get event updates and impressions by the crowd in real-time.');
};
