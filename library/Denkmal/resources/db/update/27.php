<?php

$cli = new CM_Elasticsearch_Index_Cli(null, new CM_OutputStream_Stream_StandardOutput());
$cli->create('event');

if (!CM_Db_Db::existsIndex('denkmal_model_venue', 'region')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_venue ADD KEY `region` (`region`)');
}
