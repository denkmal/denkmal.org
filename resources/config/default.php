<?php

$config->debug = true;
$config->deployVersion = '1';
$config->timeZone = 'Europe/Zurich';

$config->CM_Render->cdnResource = false;
$config->CM_Render->cdnUserContent = false;

$config->CM_Params->class = 'Denkmal_Params';

$config->CM_Site_Abstract->class = 'Denkmal_Site';

$config->CM_Db_Db->db = 'denkmal';
$config->CM_Db_Db->username = 'root';
$config->CM_Db_Db->password = 'root';
$config->CM_Db_Db->server = array('host' => '127.0.0.1', 'port' => 3306);

$config->Denkmal_Site->url = 'http://www.denkmal.local';
$config->Denkmal_Site->urlCdn = 'http://www.denkmal.local';
$config->Denkmal_Site->name = 'Denkmal.org';
$config->Denkmal_Site->emailAddress = 'kontakt@denkmal.org';

$config->Admin_Site->url = 'http://admin.denkmal.local';
$config->Admin_Site->urlCdn = 'http://www.denkmal.local';
$config->Admin_Site->name = 'Denkmal.org';
$config->Admin_Site->emailAddress = 'kontakt@denkmal.org';
