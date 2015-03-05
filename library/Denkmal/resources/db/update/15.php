<?php

if (32 === CM_Db_Db::describeColumn('denkmal_model_user', 'email')->getSize()) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_user CHANGE `email` `email` varchar(100) NOT NULL');
}
