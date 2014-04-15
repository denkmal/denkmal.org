<?php

if (100 != CM_Db_Db::describeColumn('denkmal_model_link', 'label')->getSize()) {
	CM_Db_Db::exec('ALTER TABLE denkmal_model_link CHANGE `label` `label` varchar(100) NOT NULL');
}

if (500 != CM_Db_Db::describeColumn('denkmal_model_link', 'url')->getSize()) {
	CM_Db_Db::exec('ALTER TABLE denkmal_model_link CHANGE `url` `url` varchar(500) NOT NULL');
}
