<?php

return function (CM_Model_Language $language) {
    $language->setTranslation('.internals.role.' . Denkmal_Role::ADMIN, 'Admin');
    $language->setTranslation('.internals.role.' . Denkmal_Role::PUBLISHER, 'Publisher');

    $language->setTranslation('.meta.description', '{$siteName} wird von Locals gemacht. Entdecke das Nachtleben deiner Stadt und verpasse keine spannenden Events.');
    $language->setTranslation('.meta.description.basel', 'Basels Eventkalender. WaslOift am Rheinknie und wie hört es sich an?');
    $language->setTranslation('.meta.description.graz', 'Events in Graz. Was geht in der Metropole an der Mur?');
};
