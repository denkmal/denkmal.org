<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
$bootloader = new CM_Bootloader(dirname(__DIR__) . '/', 'library/');
$bootloader->load(array('constants', 'exceptionHandler', 'errorHandler', 'defaults'));


$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$headers = apache_request_headers();
$body = file_get_contents('php://input');

$request = CM_Request_Abstract::factory($method, $uri, $headers, $body);
$response = CM_Response_Abstract::factory($request);

$response->process();
$response->sendHeaders();
echo $response->getContent();
exit;
