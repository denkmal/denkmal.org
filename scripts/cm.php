#!/usr/bin/env php
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
$bootloader = new Denkmal_Bootloader(dirname(__DIR__) . '/', 'library/');
$bootloader->setEnvironment('cli');
$bootloader->load(array('errorHandler', 'constants', 'exceptionHandler','defaults'));

$manager = new CM_Cli_CommandManager();
$manager->autoloadCommands();
$returnCode = $manager->run(new CM_Cli_Arguments($argv));
exit($returnCode);
