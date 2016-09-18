<?php

return function (CM_Config_Node $config) {
    $config->CM_App->setupScriptClasses[] = 'Denkmal_ExampleData_Users';
    $config->CM_App->setupScriptClasses[] = 'Denkmal_ExampleData_Venues';

    $config->services['stream-message'] = array(
        'class'  => 'CM_MessageStream_Factory',
        'method' => [
            'name'      => 'createService',
            'arguments' => [
                'adapterClass'     => 'CM_MessageStream_Adapter_SocketRedis',
                'adapterArguments' => [
                    'servers' => [
                        ['httpHost' => 'localhost', 'httpPort' => 8085, 'sockjsUrls' => ['https://denkmal.dev.cargomedia.ch:8090']],
                    ],
                ],
            ],
        ]
    );

    $config->services['memcache'] = array(
        'class'     => 'CM_Memcache_Client',
        'arguments' => array(
            'servers' => array(
                ['host' => 'localhost', 'port' => 11211],
            ),
        ),
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

    $config->Denkmal_Site_Default->url = 'https://denkmal.dev.cargomedia.ch';
    $config->Denkmal_Site_Default->urlCdn = 'https://origin-denkmal.dev.cargomedia.ch';
    $config->Admin_Site->url = 'https://admin-denkmal.dev.cargomedia.ch';
    $config->Admin_Site->urlCdn = 'https://origin-denkmal.dev.cargomedia.ch';

    $config->services['usercontent'] = array(
        'class'     => 'CM_Service_UserContent',
        'arguments' => array(
            'configList' => array(
                'default' => array(
                    'filesystem' => 'filesystem-usercontent',
                    'url'        => 'https://origin-denkmal.dev.cargomedia.ch/userfiles',
                )
            ),
        )
    );
};
