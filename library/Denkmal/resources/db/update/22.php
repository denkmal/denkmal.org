<?php

CM_Db_Db::truncate("cm_model_languagekey;");

$serviceManager = CM_Service_Manager::getInstance();
$loadLang = new Denkmal_App_SetupScript_LoadLanguage($serviceManager);
$loadLang->load(new CM_OutputStream_Stream_Output());

$setupTranslations = new CM_App_SetupScript_Translations($serviceManager);
$setupTranslations->load(new CM_OutputStream_Stream_Output());
