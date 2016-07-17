<?php

if (!CM_Db_Db::existsColumn('denkmal_model_region', 'twitterCredentials')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_region ADD COLUMN `twitterCredentials` VARCHAR(1000) NULL");
}

if (!CM_Db_Db::existsColumn('denkmal_model_region', 'twitterAccount')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_region ADD COLUMN `twitterAccount` VARCHAR(1000) NULL");
}

if (!CM_Db_Db::existsColumn('denkmal_model_region', 'facebookAccount')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_region ADD COLUMN `facebookAccount` VARCHAR(1000) NULL");
}

if (!CM_Db_Db::existsColumn('denkmal_model_region', 'emailAddress')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_region ADD COLUMN `emailAddress` VARCHAR(1000)");
}

CM_Db_Db::exec("UPDATE denkmal_model_region SET emailAddress='basel@denkmal.org' WHERE slug='basel'");
CM_Db_Db::exec("UPDATE denkmal_model_region SET facebookAccount='denkmal.org' WHERE slug='basel'");
CM_Db_Db::exec("UPDATE denkmal_model_region SET twitterAccount='denkmal_basel' WHERE slug='basel'");

CM_Db_Db::exec("UPDATE denkmal_model_region SET emailAddress='graz@denkmal.org' WHERE slug='graz'");
