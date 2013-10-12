#!/usr/bin/env php
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
$bootloader = new Denkmal_Bootloader(dirname(__DIR__) . '/', 'library/');
$bootloader->load(array('constants', 'exceptionHandler', 'errorHandler', 'defaults'));

echo "test\n";
