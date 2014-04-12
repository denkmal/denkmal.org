<?php

$config->CM_Mail->send = false;
$config->CM_Redis_Client->server = array('host' => '127.0.0.1', 'port' => 6379);
$config->CM_Stream_Adapter_Message_SocketRedis->servers = array(
    array('httpHost' => 'localhost', 'httpPort' => 8085, 'sockjsUrls' => array('http://www.denkmal.dev:8090')),
);
$config->CM_Search->servers = array(
    array('host' => '127.0.0.1', 'port' => 9200),
);
$config->CM_Memcache_Client->servers = array(
    array('host' => '127.0.0.1', 'port' => 11211),
);
$config->CM_Db_Db->db = 'denkmal';
$config->CM_Db_Db->username = 'root';
$config->CM_Db_Db->password = '';
$config->CM_Db_Db->server = array('host' => '127.0.0.1', 'port' => 3306);
$config->CM_Stream_Video->servers = array(
    array('publicHost' => 'www.denkmal.dev', 'publicIp' => '127.0.0.1', 'privateIp' => '127.0.0.1'),
);
$config->CM_Jobdistribution_JobWorker->servers = array(
    array('host' => 'localhost', 'port' => 4730),
);
$config->CM_Jobdistribution_Job_Abstract->servers = array(
    array('host' => 'localhost', 'port' => 4730),
);
$config->SK_PaymentProvider_Abstract->withoutRemoteConnection = true;
$config->SK_ModelAsset_User_Reviews->processPendingEnabled = false;
$config->SK_Entertainment_Schedule_Abstract->executingEnabled = false;
$config->SK_Entertainment_UserTemplate->entertainerCountMin = 20;
$config->CM_Model_Splittest->withoutPersistence = true;
$config->CM_Model_Splitfeature->withoutPersistence = true;

$config->Denkmal_Site->url = 'http://www.denkmal.dev';
$config->Denkmal_Site->urlCdn = 'http://origin-www.denkmal.dev';
$config->Admin_Site->url = 'http://admin.denkmal.dev';
$config->Admin_Site->urlCdn = 'http://origin-www.denkmal.dev';
