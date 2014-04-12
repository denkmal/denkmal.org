<?php

# URLs
if (CM_Db_Db::existsTable('url')) {
    $rows = CM_Db_Db::exec('SELECT * FROM url GROUP BY name')->fetchAll();
    foreach ($rows as $row) {
        Denkmal_Model_Link::create($row['name'], $row['url'], !((bool) $row['onlyifmarked']));
    }
    CM_Db_Db::exec('DROP TABLE url');
}
