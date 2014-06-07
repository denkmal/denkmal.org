<?php

return function (CM_Config_Node $config) {
    $config->dayOffset = 6;

    $config->Denkmal_Response_Api_Message->hashToken = 'denkmal.dev';
    $config->Denkmal_Response_Api_Message->hashAlgorithm = 'sha1';

    $config->Denkmal_Scraper_Source_Abstract->dayCount = 10;
    $config->Denkmal_Scraper_Date->defaultTimeHour = 22;

    $config->CM_Stream_Video->servers = array();
};
