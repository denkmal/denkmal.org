<?php

if (!CM_Db_Db::existsTable('denkmal_scraper_facebookpage')) {
    CM_Db_Db::exec('
CREATE TABLE IF NOT EXISTS `denkmal_scraper_facebookpage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `facebookPage` int(11) unsigned NOT NULL,
  `region` int(11) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facebookPage` (`facebookPage`),
  KEY `created` (`created`),
  KEY `region` (`region`),
  CONSTRAINT `denkmal_scraper_facebookpage__facebookpage` FOREIGN KEY (`facebookPage`) REFERENCES `denkmal_model_facebookpage` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `denkmal_scraper_facebookpage__region` FOREIGN KEY (`region`) REFERENCES `denkmal_model_region` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}
