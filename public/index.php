<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
$bootloader = new CM_Bootloader(dirname(__DIR__) . '/');
$bootloader->load();

$exitCode = $bootloader->execute(function () {
    $request = CM_Http_Request_Abstract::factoryFromGlobals();
    $response = CM_App::getInstance()->getHttpHandler()->processRequest($request);
    $response->send();
});

exit($exitCode);
