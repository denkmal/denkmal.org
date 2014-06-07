<?php

return function (CM_Config_Node $config) {
    $config->CM_Mail->send = false;
    $config->CM_Redis_Client->server = array('host' => '127.0.0.1', 'port' => 6379);
    $config->CM_Stream_Adapter_Message_SocketRedis->servers = array(
        array('httpHost' => 'localhost', 'httpPort' => 8085, 'sockjsUrls' => array('http://www.denkmal.dev:8090')),
    );
    $config->CM_Elasticsearch_Client->servers = array(
        array('host' => '127.0.0.1', 'port' => 9200),
    );
    $config->CM_Memcache_Client->servers = array(
        array('host' => '127.0.0.1', 'port' => 11211),
    );
    $config->CM_Db_Db->db = 'denkmal';
    $config->CM_Db_Db->username = 'root';
    $config->CM_Db_Db->password = '';
    $config->CM_Db_Db->server = array('host' => '127.0.0.1', 'port' => 3306);
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

    $config->Denkmal_Scraper_Source_Lastfm->apiKey = '68dda0be24c60cef36b7f05b70988b74';

    $config->Denkmal_Site->url = 'http://www.denkmal.dev';
    $config->Denkmal_Site->urlCdn = 'http://origin-www.denkmal.dev';
    $config->Admin_Site->url = 'http://admin.denkmal.dev';
    $config->Admin_Site->urlCdn = 'http://origin-www.denkmal.dev';

    $config->services['usercontent'] = array(
        'class'     => 'CM_Service_UserContent',
        'arguments' => array(array(
            'default' => array(
                'filesystem' => 'filesystem-usercontent',
                'url'        => 'http://origin-www.denkmal.dev/userfiles',
            )
        )));
};
