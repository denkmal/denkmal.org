<?php

# URLs
if (CM_Db_Db::existsTable('url')) {
    echo 'Importing urls...' . PHP_EOL;
    $rows = CM_Db_Db::exec('SELECT * FROM url GROUP BY name')->fetchAll();
    foreach ($rows as $row) {
        Denkmal_Model_Link::create($row['name'], $row['url'], !((bool) $row['onlyifmarked']));
    }
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
        foreach ($aliases as $alias) {
            Denkmal_Model_VenueAlias::create($venue, $alias['name']);
        }
    }
}

# Events
if (CM_Db_Db::existsTable('event') && CM_Db_Db::existsTable('location')) {
    echo 'Importing events...' . PHP_EOL;
    $events = CM_Db_Db::exec('SELECT e.*, l.name FROM event e JOIN location l ON e.locationId = l.id')->fetchAll();
    foreach ($events as $event) {
        if ('0000-00-00 00:00:00' == $event['from']) {
            continue;
        }
        $venue = Denkmal_Model_Venue::findByName($event['name']);
        if (!$venue) {
            throw new CM_Exception('No venue found for: ' . $event['name']);
        }
        $song = null;
        if ($event['audio']) {
            $song = Denkmal_Model_Song::findByLabel($event['audio']);
            if (!$song) {
                throw new CM_Exception('No song found for: ' . $event['audio']);
            }
        }
        $dateFrom = new DateTime($event['from']);
        $dateUntil = null;
        if ($event['until']) {
            $dateUntil = new DateTime($event['until']);
        }
        $enabled = $event['enabled'];
        $locked = $event['locked'];
        $blocked = $event['blocked'];
        Denkmal_Model_Event::create($venue, $event['description'], ($enabled && !$blocked), (!$enabled && !$blocked),
            $dateFrom, $dateUntil, null, $song, $blocked, $event['star']);
    }
}
