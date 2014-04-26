<?php

if (CM_Db_Db::existsColumn('denkmal_model_event', 'title')) {
    $rows = CM_Db_Db::select('denkmal_model_event', '*', 'title IS NOT NULL')->fetchAll();
    foreach ($rows as $row) {
        $title = trim($row['title']);
        if (strlen($title) > 0) {
            $description = $title . ': ' . $row['description'];
            CM_Db_Db::update('denkmal_model_event', array('description' => $description), array('id' => $row['id']));
        }
    }
    CM_Db_Db::exec('ALTER TABLE denkmal_model_event DROP title');

    $searchCli = new CM_Elasticsearch_Index_Cli(null, new CM_OutputStream_Stream_Output());
    $searchCli->create('event');
}
