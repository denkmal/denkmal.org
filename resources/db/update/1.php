<?php

# URLs
if (CM_Db_Db::existsTable('url')) {
    echo 'Importing urls...' . PHP_EOL;
    $rows = CM_Db_Db::exec('SELECT * FROM url GROUP BY name')->fetchAll();
    foreach ($rows as $row) {
        Denkmal_Model_Link::create($row['name'], $row['url'], !((bool) $row['onlyifmarked']));
    }
    CM_Db_Db::exec('DROP TABLE url');
}

# Songs
if (is_dir('/tmp/audio')) {
    echo 'Importing songs...' . PHP_EOL;
    $paths = glob('/tmp/audio/*.mp3');
    foreach ($paths as $path) {
        $file = new CM_File($path);
        $label = strtolower($file->getFileNameWithoutExtension());
        Denkmal_Model_Song::create($label, $file);
    }
}
