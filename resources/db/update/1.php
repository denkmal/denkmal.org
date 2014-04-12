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

# Location
if (CM_Db_Db::existsTable('location')) {
    echo 'Importing locations...' . PHP_EOL;
    $rows = CM_Db_Db::select('location', '*')->fetchAll();
    foreach ($rows as $row) {
        $aliases = CM_Db_Db::select('location_alias', '*', array('locationId' => $row['id']))->fetchAll();
        $enabled = (bool) $row['enabled'];
        $blocked = (bool) $row['blocked'];
        $queued = !$enabled && !$blocked;
        $location = null;
        if ($row['latitude'] && $row['longitude']) {
            $location = new CM_Geo_Point($row['latitude'], $row['longitude']);
        }
        $venue = Denkmal_Model_Venue::create($row['name'], $queued, $blocked, $row['url'], $row['notes'], $location);
        foreach($aliases as $alias) {
            Denkmal_Model_VenueAlias::create($venue, $alias['name']);
        }
    }
    CM_Db_Db::exec('DROP TABLE location');
    CM_Db_Db::exec('DROP TABLE location_alias');
    CM_Db_Db::exec('DROP TABLE location_unknown');
}
