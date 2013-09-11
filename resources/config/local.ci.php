<?php

$config->CM_Db_Db->db = 'denkmal';
$config->CM_Db_Db->username = 'denkmal';
$config->CM_Db_Db->password = 'denkmal';
$config->CM_Db_Db->server = array('host' => '10.10.10.101', 'port' => 3306);

$config->CM_Cache_Memcache->servers = array(
	array('host' => '10.10.10.100', 'port' => 11211),
);
