<?php

$config->debug = true;
$config->timeZone = 'Europe/Zurich';
$config->googleApi = 'AIzaSyB85laUBhcLyjf7vff7WE62__6jPxjK8qI';

$config->CM_Model_User->class = 'Denkmal_Model_User';

$config->CM_Params->class = 'Denkmal_Params';

$config->CM_Site_Abstract->class = 'Denkmal_Site';

$config->CM_Stream_Adapter_Message_SocketRedis->hostPrefix = false;
$config->CM_Stream_Adapter_Message_SocketRedis->servers = array(
	array('httpHost' => 'localhost', 'httpPort' => 8085, 'sockjsUrls' => array(
		'http://www.denkmal.dev:8090',
	)),
);

$config->CM_Db_Db->db = 'denkmal';
$config->CM_Db_Db->username = 'root';
$config->CM_Db_Db->password = '';
$config->CM_Db_Db->server = array('host' => '127.0.0.1', 'port' => 3306);

$config->Denkmal_Site->url = 'http://www.denkmal.dev';
$config->Denkmal_Site->urlCdn = 'http://origin-www.denkmal.dev';
$config->Denkmal_Site->name = 'Denkmal.org';
$config->Denkmal_Site->emailAddress = 'kontakt@denkmal.org';

$config->Admin_Site->url = 'http://admin.denkmal.dev';
$config->Admin_Site->urlCdn = 'http://origin-www.denkmal.dev';
$config->Admin_Site->name = 'Denkmal.org';
$config->Admin_Site->emailAddress = 'kontakt@denkmal.org';
