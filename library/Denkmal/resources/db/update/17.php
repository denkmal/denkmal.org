<?php

if (!CM_Db_Db::existsColumn('denkmal_model_tag_model', 'id')) {
    CM_Db_Db::exec('
      ALTER TABLE denkmal_model_tag_model
      ADD COLUMN `id` int(11) unsigned NOT NULL AUTO_INCREMENT FIRST,
      DROP PRIMARY KEY,
      ADD PRIMARY KEY(`id`),
      ADD KEY `modelType-modelId-tagId` (`modelType`, `modelId`, `tagId`)
    ');
}
