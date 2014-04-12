<?php

return;

# URLs
if (CM_Db_Db::existsTable('url')) {
    echo 'Importing urls...' . PHP_EOL;
    $rows = CM_Db_Db::exec('SELECT * FROM url GROUP BY name')->fetchAll();
    foreach ($rows as $i => $row) {
        echo '  ' . $i . '/' . count($rows) . "\r";
        Denkmal_Model_Link::create($row['name'], $row['url'], !((bool) $row['onlyifmarked']));
    }
    echo "\n";
}

# Songs
if (is_dir('/tmp/audio')) {
    echo 'Importing songs...' . PHP_EOL;
    $paths = glob('/tmp/audio/*.mp3');
    foreach ($paths as $i => $path) {
        echo '  ' . $i . '/' . count($paths) . "\r";
        $file = new CM_File($path);
        $label = strtolower($file->getFileNameWithoutExtension());
        Denkmal_Model_Song::create($label, $file);
    }
    echo "\n";
}

# Location
if (CM_Db_Db::existsTable('location')) {
    echo 'Importing locations...' . PHP_EOL;
    $rows = CM_Db_Db::select('location', '*')->fetchAll();
    foreach ($rows as $i => $row) {
        echo '  ' . $i . '/' . count($rows) . "\r";
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
    echo "\n";
}

# Events
if (CM_Db_Db::existsTable('event') && CM_Db_Db::existsTable('location')) {
    echo 'Importing events...' . PHP_EOL;
    $now = new DateTime();
    $events = CM_Db_Db::exec('SELECT e.*, l.name FROM event e JOIN location l ON e.locationId = l.id')->fetchAll();
    foreach ($events as $i => $event) {
        echo '  ' . $i . '/' . count($events) . "\r";
        if ('0000-00-00 00:00:00' == $event['from']) {
            continue;
        }
        $venue = Denkmal_Model_Venue::findByName($event['name']);
        if (!$venue) {
            throw new CM_Exception('No venue found for: ' . $event['name']);
        }
        $song = null;
        if ($event['audio']) {
            $songName = strtolower($event['audio']);
            $songName = preg_replace('/.mp3$/', '', $songName);
            $song = Denkmal_Model_Song::findByLabel($songName);
            if (!$song) {
                echo PHP_EOL . 'Warning: No song found for: ' . $event['audio'] . PHP_EOL;
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
        if ((!$enabled && !$blocked) && $dateFrom < $now) {
            echo PHP_EOL . 'Warning: Ignoring queued event in past: ' . $dateFrom->format('Y-m-d') . ' - ' . $event['description'] . PHP_EOL;
        }
        Denkmal_Model_Event::create($venue, $event['description'], ($enabled && !$blocked), (!$enabled && !$blocked),
            $dateFrom, $dateUntil, null, $song, $blocked, $event['star']);
    }
    echo "\n";
}

foreach (array('event', 'location', 'location_alias', 'location_unknown', 'promotion', 'promotion_entry', 'url', 'user', 'weblink') as $table) {
    CM_Db_Db::exec('DROP TABLE ' . $table);
}
