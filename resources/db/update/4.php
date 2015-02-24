<?php

$rowList = CM_Db_Db::select('denkmal_model_link', '*', "`url` LIKE 'http://www.myspace.com/%'")->fetchAll();
foreach ($rowList as $row) {
    $id = $row['id'];
    $url = $row['url'];
    $url = str_replace('http://www.myspace.com/', 'https://myspace.com/', $url);
    CM_Db_Db::update('denkmal_model_link', ['url' => $url], ['id' => $id]);
}
