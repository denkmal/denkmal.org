<?php

$cli = new CM_Elasticsearch_Index_Cli(null, new CM_OutputStream_Stream_StandardOutput());
$cli->create('event');
