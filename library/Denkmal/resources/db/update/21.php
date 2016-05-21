<?php

$langList = new CM_Paging_Language_All();
foreach ($langList as $lang) {
    $lang->delete();
}

$serviceManager = CM_Service_Manager::getInstance();
$loadLang = new Denkmal_App_SetupScript_LoadLanguage($serviceManager);
$loadLang->load(new CM_OutputStream_Stream_Output());

$setupTranslations = new CM_App_SetupScript_Translations($serviceManager);
$setupTranslations->load(new CM_OutputStream_Stream_Output());
