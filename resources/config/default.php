<?php

return function (CM_Config_Node $config) {
    $config->installationName = 'denkmal';

    $config->CM_Site_Abstract->class = 'Denkmal_Site_Default';
    $config->CM_Model_User->class = 'Denkmal_Model_User';
    $config->CM_Params->class = 'Denkmal_Params';

    $config->timeZone = 'Europe/Zurich';

    $config->services['google-static-maps'] = [
        'class'     => 'Denkmal_GoogleMaps_StaticMaps',
        'arguments' => [
            'apiKey' => 'AIzaSyC5s-73wOdKqfCzNXV6YNJ-RNgJOl6HL80',
        ]
    ];

    $config->Denkmal_Site_Default->name = 'Denkmal.org';
    $config->Denkmal_Site_Default->emailAddress = 'kontakt@denkmal.org';
    $config->Denkmal_Site_Default->webFontLoaderConfig = [
        'google' => ['families' => ['Open Sans']]
    ];
};
