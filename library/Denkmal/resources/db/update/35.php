<?php

CM_Db_Db::exec('
ALTER TABLE `denkmal_scraper_facebookpage`
DROP KEY `facebookPage`,
ADD KEY `facebookPage` (`facebookPage`)
');
