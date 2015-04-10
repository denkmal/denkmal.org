<?php

return function (CM_Config_Node $config) {
    $config->CM_App->setupScriptClasses[] = 'Denkmal_ExampleData_Users';
    $config->CM_App->setupScriptClasses[] = 'Denkmal_ExampleData_Venues';

    $config->CM_Mail->send = false;
    $config->CM_Stream_Adapter_Message_SocketRedis->servers = array(
        array('httpHost' => 'localhost', 'httpPort' => 8085, 'sockjsUrls' => array('http://www.denkmal.dev:8090')),
    );
    $config->CM_Memcache_Client->servers = array(
        array('host' => '127.0.0.1', 'port' => 11211),
    );
    $config->services['database-master'] = array(
        'class'     => 'CM_Db_Client',
        'arguments' => array(
            'config' => array(
                'host'             => '127.0.0.1',
                'port'             => 3306,
                'username'         => 'root',
                'password'         => '',
                'db'               => 'denkmal',
                'reconnectTimeout' => 300
            ),
        )
    );
    $config->CM_Jobdistribution_Job_Abstract->servers = array(
        array('host' => 'localhost', 'port' => 4730),
    );

    $config->Denkmal_Scraper_Source_Lastfm->apiKey = '68dda0be24c60cef36b7f05b70988b74';

    $config->Denkmal_Site->url = 'http://www.denkmal.dev';
    $config->Admin_Site->url = 'http://admin.denkmal.dev';

    $config->services['usercontent'] = array(
        'class'     => 'CM_Service_UserContent',
        'arguments' => array(
            'configList' => array(
                'default' => array(
                    'filesystem' => 'filesystem-usercontent',
                    'url'        => '/userfiles',
                )
            ),
        )
    );
};
