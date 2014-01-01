<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
$bootloader = new Denkmal_Bootloader(dirname(__DIR__) . '/', 'library/');
$bootloader->load(array('errorHandler', 'constants', 'exceptionHandler', 'defaults'));

$request = CM_Request_Abstract::factoryFromGlobals();
$response = CM_Response_Abstract::factory($request);

$response->process();
$response->send();
exit;
