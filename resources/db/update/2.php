<?php

/** @var Denkmal_Model_Link $link */
foreach (new Denkmal_Paging_Link_Broken() as $link) {
    $link->setFailedCount(0);
}
