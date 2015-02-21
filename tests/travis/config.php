<?php

return function (CM_Config_Node $config) {
    $config->CM_Elasticsearch_Client->servers = array(
      array('host' => 'localhost', 'port' => 9200),
    );
    $config->CM_Memcache_Client->servers = array(
      array('host' => 'localhost', 'port' => 11211),
    );

    $config->Denkmal_Site->url = 'http://www.denkmal.dev';
    $config->Admin_Site->url = 'http://admin.denkmal.dev';
};
