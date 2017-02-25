<?php
// This is autogenerated config file. You should not change it manually.

return function (CM_Config_Node $config) {
    $config->CM_Action_Abstract->types = [];
    $config->CM_Action_Abstract->types[3] = CM_Action_Email::class;
    $config->CM_Janus_ServerList->types = [];
    $config->CM_Janus_ServerList->types[82] = CM_Janus_ServerList::class;
    $config->CM_Janus_ServerList->type = 82;
    $config->CM_Mail_Mailable->types = [];
    $config->CM_Mail_Mailable->types[1] = CM_Mail_Mailable::class;
    $config->CM_Mail_Mailable->types[2] = CM_Mail_ExampleMailable::class;
    $config->CM_Mail_Mailable->types[38] = Admin_Mail_EventNotification::class;
    $config->CM_Mail_Mailable->types[62] = Denkmal_Mail_UserInvite::class;
    $config->CM_Mail_Mailable->type = 1;
    $config->CM_MediaStreams_Service->types = [];
    $config->CM_MediaStreams_Service->types[68] = CM_Janus_Service::class;
    $config->CM_Model_Abstract->types = [];
    $config->CM_Model_Abstract->types[5] = CM_Model_Language::class;
    $config->CM_Model_Abstract->types[6] = CM_Model_Location::class;
    $config->CM_Model_Abstract->types[7] = CM_Model_Splitfeature::class;
    $config->CM_Model_Abstract->types[8] = CM_Model_Splittest::class;
    $config->CM_Model_Abstract->types[9] = CM_Model_SplittestVariation::class;
    $config->CM_Model_Abstract->types[10] = CM_Model_User::class;
    $config->CM_Model_Abstract->types[11] = CM_Model_Splittest_RequestClient::class;
    $config->CM_Model_Abstract->types[12] = CM_Model_Splittest_User::class;
    $config->CM_Model_Abstract->types[13] = CM_Model_Stream_Publish::class;
    $config->CM_Model_Abstract->types[14] = CM_Model_Stream_Subscribe::class;
    $config->CM_Model_Abstract->types[15] = CM_Model_StreamChannel_Message::class;
    $config->CM_Model_Abstract->types[17] = CM_Model_StreamChannel_Message_User::class;
    $config->CM_Model_Abstract->types[28] = Denkmal_Model_Event::class;
    $config->CM_Model_Abstract->types[31] = Denkmal_Model_Song::class;
    $config->CM_Model_Abstract->types[32] = Denkmal_Model_User::class;
    $config->CM_Model_Abstract->types[33] = Denkmal_Model_Venue::class;
    $config->CM_Model_Abstract->types[34] = Denkmal_Model_VenueAlias::class;
    $config->CM_Model_Abstract->types[39] = CM_Model_Location_City::class;
    $config->CM_Model_Abstract->types[40] = CM_Model_Location_Country::class;
    $config->CM_Model_Abstract->types[41] = CM_Model_Location_State::class;
    $config->CM_Model_Abstract->types[42] = CM_Model_Location_Zip::class;
    $config->CM_Model_Abstract->types[43] = CM_Model_LanguageKey::class;
    $config->CM_Model_Abstract->types[51] = Denkmal_Scraper_SourceResult::class;
    $config->CM_Model_Abstract->types[61] = Denkmal_Model_UserInvite::class;
    $config->CM_Model_Abstract->types[63] = Denkmal_Push_Subscription::class;
    $config->CM_Model_Abstract->types[64] = Denkmal_Push_Notification_Message::class;
    $config->CM_Model_Abstract->types[65] = CM_Model_Currency::class;
    $config->CM_Model_Abstract->types[70] = CM_Model_StreamChannel_Media::class;
    $config->CM_Model_Abstract->types[71] = CM_Model_StreamChannelArchive_Media::class;
    $config->CM_Model_Abstract->types[72] = CM_StreamChannel_Thumbnail::class;
    $config->CM_Model_Abstract->types[77] = Denkmal_Model_Region::class;
    $config->CM_Model_Abstract->types[83] = CM_Janus_StreamChannel::class;
    $config->CM_Model_Abstract->types[87] = Denkmal_Model_FacebookPage::class;
    $config->CM_Model_Abstract->types[90] = CM_Migration_Model::class;
    $config->CM_Model_Abstract->types[91] = Denkmal_Model_EventLink::class;
    $config->CM_Model_Abstract->types[92] = Denkmal_Model_EventCategory::class;
    $config->CM_Paging_Log->types = [];
    $config->CM_Paging_Log->types[74] = CM_Paging_Log::class;
    $config->CM_Paging_Log->types[75] = CM_Paging_Log_Javascript::class;
    $config->CM_Paging_Log->types[76] = CM_Paging_Log_Mail::class;
    $config->CM_Paging_Log->type = 74;
    $config->CM_Paging_ContentList_Abstract->types = [];
    $config->CM_Paging_ContentList_Abstract->types[19] = CM_Paging_ContentList_Badwords::class;
    $config->CM_Provision_Script_OptionBased->types = [];
    $config->CM_Provision_Script_OptionBased->types[52] = CM_Http_SetupScript::class;
    $config->CM_Provision_Script_OptionBased->types[53] = CM_App_SetupScript_Translations::class;
    $config->CM_Provision_Script_OptionBased->types[54] = CM_Elasticsearch_SetupScript::class;
    $config->CM_Provision_Script_OptionBased->types[55] = Denkmal_App_SetupScript_LoadLanguage::class;
    $config->CM_Provision_Script_OptionBased->types[56] = Denkmal_ExampleData_Users::class;
    $config->CM_Provision_Script_OptionBased->types[60] = Denkmal_ExampleData_Venues::class;
    $config->CM_Provision_Script_OptionBased->types[66] = CM_App_SetupScript_Currency::class;
    $config->CM_Provision_Script_OptionBased->types[78] = Denkmal_App_SetupScript_Locations::class;
    $config->CM_Provision_Script_OptionBased->types[93] = Denkmal_App_SetupScript_EventCategories::class;
    $config->CM_Site_Abstract->types = [];
    $config->CM_Site_Abstract->types[36] = Admin_Site::class;
    $config->CM_Site_Abstract->types[79] = Denkmal_Site_Default::class;
    $config->CM_Site_Abstract->types[80] = Denkmal_Site_Region_Basel::class;
    $config->CM_Site_Abstract->types[81] = Denkmal_Site_Region_Graz::class;
    $config->CM_Stream_Adapter_Abstract->types = [];
    $config->CM_Stream_Adapter_Abstract->types[25] = CM_MessageStream_Adapter_SocketRedis::class;
    $config->Denkmal_Scraper_Source_Abstract->types = [];
    $config->Denkmal_Scraper_Source_Abstract->types[45] = Denkmal_Scraper_Source_Fingerzeig::class;
    $config->Denkmal_Scraper_Source_Abstract->types[46] = Denkmal_Scraper_Source_Hinterhof::class;
    $config->Denkmal_Scraper_Source_Abstract->types[47] = Denkmal_Scraper_Source_Kaschemme::class;
    $config->Denkmal_Scraper_Source_Abstract->types[48] = Denkmal_Scraper_Source_Lastfm::class;
    $config->Denkmal_Scraper_Source_Abstract->types[49] = Denkmal_Scraper_Source_Programmzeitung::class;
    $config->Denkmal_Scraper_Source_Abstract->types[50] = Denkmal_Scraper_Source_Saali::class;
    $config->Denkmal_Scraper_Source_Abstract->types[73] = Denkmal_Scraper_Source_Apawi::class;
    $config->Denkmal_Scraper_Source_Abstract->types[84] = Denkmal_Scraper_Source_Facebook_Venues::class;
    $config->Denkmal_Scraper_Source_Abstract->types[85] = Denkmal_Scraper_Source_Graz_Postgarage::class;
    $config->Denkmal_Scraper_Source_Abstract->types[86] = Denkmal_Scraper_Source_Graz_Sub::class;
    $config->Denkmal_Scraper_Source_Abstract->types[88] = Denkmal_Scraper_Source_Facebook_PageList::class;
    $config->Denkmal_Scraper_Source_Abstract->types[89] = Denkmal_Scraper_Source_Basel_Renee::class;
    $config->CM_Mail_ExampleMailable->type = 2;
    $config->CM_Action_Email->type = 3;
    $config->CM_Model_Language->type = 5;
    $config->CM_Model_Location->type = 6;
    $config->CM_Model_Splitfeature->type = 7;
    $config->CM_Model_Splittest->type = 8;
    $config->CM_Model_SplittestVariation->type = 9;
    $config->CM_Model_User->type = 10;
    $config->CM_Model_Splittest_RequestClient->type = 11;
    $config->CM_Model_Splittest_User->type = 12;
    $config->CM_Model_Stream_Publish->type = 13;
    $config->CM_Model_Stream_Subscribe->type = 14;
    $config->CM_Model_StreamChannel_Message->type = 15;
    $config->CM_Model_StreamChannel_Message_User->type = 17;
    $config->CM_Paging_ContentList_Badwords->type = 19;
    $config->CM_MessageStream_Adapter_SocketRedis->type = 25;
    $config->Denkmal_Model_Event->type = 28;
    $config->Denkmal_Model_Song->type = 31;
    $config->Denkmal_Model_User->type = 32;
    $config->Denkmal_Model_Venue->type = 33;
    $config->Denkmal_Model_VenueAlias->type = 34;
    $config->Admin_Site->type = 36;
    $config->Admin_Mail_EventNotification->type = 38;
    $config->CM_Model_Location_City->type = 39;
    $config->CM_Model_Location_Country->type = 40;
    $config->CM_Model_Location_State->type = 41;
    $config->CM_Model_Location_Zip->type = 42;
    $config->CM_Model_LanguageKey->type = 43;
    $config->Denkmal_Scraper_Source_Fingerzeig->type = 45;
    $config->Denkmal_Scraper_Source_Hinterhof->type = 46;
    $config->Denkmal_Scraper_Source_Kaschemme->type = 47;
    $config->Denkmal_Scraper_Source_Lastfm->type = 48;
    $config->Denkmal_Scraper_Source_Programmzeitung->type = 49;
    $config->Denkmal_Scraper_Source_Saali->type = 50;
    $config->Denkmal_Scraper_SourceResult->type = 51;
    $config->CM_Http_SetupScript->type = 52;
    $config->CM_App_SetupScript_Translations->type = 53;
    $config->CM_Elasticsearch_SetupScript->type = 54;
    $config->Denkmal_App_SetupScript_LoadLanguage->type = 55;
    $config->Denkmal_ExampleData_Users->type = 56;
    $config->Denkmal_ExampleData_Venues->type = 60;
    $config->Denkmal_Model_UserInvite->type = 61;
    $config->Denkmal_Mail_UserInvite->type = 62;
    $config->Denkmal_Push_Subscription->type = 63;
    $config->Denkmal_Push_Notification_Message->type = 64;
    $config->CM_Model_Currency->type = 65;
    $config->CM_App_SetupScript_Currency->type = 66;
    $config->CM_Janus_Service->type = 68;
    $config->CM_Model_StreamChannel_Media->type = 70;
    $config->CM_Model_StreamChannelArchive_Media->type = 71;
    $config->CM_StreamChannel_Thumbnail->type = 72;
    $config->Denkmal_Scraper_Source_Apawi->type = 73;
    $config->CM_Paging_Log_Javascript->type = 75;
    $config->CM_Paging_Log_Mail->type = 76;
    $config->Denkmal_Model_Region->type = 77;
    $config->Denkmal_App_SetupScript_Locations->type = 78;
    $config->Denkmal_Site_Default->type = 79;
    $config->Denkmal_Site_Region_Basel->type = 80;
    $config->Denkmal_Site_Region_Graz->type = 81;
    $config->CM_Janus_StreamChannel->type = 83;
    $config->Denkmal_Scraper_Source_Facebook_Venues->type = 84;
    $config->Denkmal_Scraper_Source_Graz_Postgarage->type = 85;
    $config->Denkmal_Scraper_Source_Graz_Sub->type = 86;
    $config->Denkmal_Model_FacebookPage->type = 87;
    $config->Denkmal_Scraper_Source_Facebook_PageList->type = 88;
    $config->Denkmal_Scraper_Source_Basel_Renee->type = 89;
    $config->CM_Migration_Model->type = 90;
    $config->Denkmal_Model_EventLink->type = 91;
    $config->Denkmal_Model_EventCategory->type = 92;
    $config->Denkmal_App_SetupScript_EventCategories->type = 93;
    $config->CM_Class_Abstract->typesMaxValue = 93;
    
    $config->CM_Action_Abstract->verbs = [];
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::CREATE] = 1;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::UPDATE] = 2;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::DELETE] = 3;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::ONLINE] = 4;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::OFFLINE] = 5;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::VIEW] = 6;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::VISIBLE] = 7;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::INVISIBLE] = 8;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::PUBLISH] = 9;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::UNPUBLISH] = 10;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::SUBSCRIBE] = 11;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::UNSUBSCRIBE] = 12;
    $config->CM_Action_Abstract->verbs[CM_Action_Abstract::SEND] = 13;
    $config->CM_Action_Abstract->verbsMaxValue = 13;
    
};
