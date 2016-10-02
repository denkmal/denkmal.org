<?php

class Admin_Menu_Main extends CM_Menu {

    public function __construct() {
        parent::__construct([
            ['label' => 'Events', 'page' => 'Admin_Page_Events'],
            ['label' => 'Venues', 'page' => 'Admin_Page_Venues'],
            ['label' => 'Links', 'page' => 'Admin_Page_Links'],
            ['label' => 'Songs', 'page' => 'Admin_Page_Songs'],
            ['label' => 'More…', 'page' => 'Admin_Page_Scraper', 'submenu' => [
                ['label' => 'Scraper', 'page' => 'Admin_Page_Scraper', 'submenu' => [
                    ['label' => 'Stats', 'page' => 'Admin_Page_Scraper'],
                    ['label' => 'Facebook', 'page' => 'Admin_Page_Scraper_Facebook'],
                ]],
                ['label' => 'Translations', 'page' => 'Admin_Page_Translations'],
                ['label' => 'Users', 'page' => 'Admin_Page_Users'],
                ['label' => 'Invites', 'page' => 'Admin_Page_UserInvites'],
                ['label' => 'Logs', 'page' => 'Admin_Page_Log', 'params' => ['level' => CM_Log_Logger::CRITICAL], 'submenu' => [
                    ['label' => 'Critical', 'page' => 'Admin_Page_Log', 'params' => ['level' => CM_Log_Logger::CRITICAL]],
                    ['label' => 'Errors', 'page' => 'Admin_Page_Log', 'params' => ['level' => CM_Log_Logger::ERROR]],
                    ['label' => 'Warnings', 'page' => 'Admin_Page_Log', 'params' => ['level' => CM_Log_Logger::WARNING]],
                    ['label' => 'Info', 'page' => 'Admin_Page_Log', 'params' => ['level' => CM_Log_Logger::INFO]],
                    ['label' => 'Mail', 'page' => 'Admin_Page_Log', 'params' => ['type' => CM_Paging_Log_Mail::getTypeStatic()]],
                ]],
                ['label' => 'Settings', 'page' => 'Admin_Page_Settings'],
                ['label' => 'Email Preview', 'page' => 'Admin_Page_EmailPreview'],
            ]],
        ]);
    }
}
