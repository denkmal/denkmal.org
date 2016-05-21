<?php

return function (CM_Config_Node $config) {
    $config->installationName = 'denkmal';

    $config->CM_Site_Abstract->class = 'Denkmal_Site_Default';
    $config->CM_Model_User->class = 'Denkmal_Model_User';
    $config->CM_Params->class = 'Denkmal_Params';

    $config->timeZone = 'Europe/Zurich';
    $config->googleApi = 'AIzaSyB85laUBhcLyjf7vff7WE62__6jPxjK8qI';

    $config->Denkmal_Site_Abstract->name = 'Denkmal.org';
    $config->Denkmal_Site_Abstract->emailAddress = 'kontakt@denkmal.org';
};
