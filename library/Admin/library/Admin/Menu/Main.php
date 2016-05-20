<?php

class Admin_Menu_Main extends CM_Menu {

    public function __construct() {
        parent::__construct(array(
            array('label' => 'Veranstaltungen', 'page' => 'Admin_Page_Events'),
            array('label' => 'Orte', 'page' => 'Admin_Page_Venues'),
            array('label' => 'Links', 'page' => 'Admin_Page_Links'),
            array('label' => 'Lieder', 'page' => 'Admin_Page_Songs'),
            array('label'   => 'Mehr…', 'page' => 'Admin_Page_Scraper',
                  'submenu' => array(
                      array('label' => 'Scraper', 'page' => 'Admin_Page_Scraper'),
                      array('label' => 'Benutzer', 'page' => 'Admin_Page_Users'),
                      array('label' => 'Einladungen', 'page' => 'Admin_Page_UserInvites'),
                      array('label' => 'Critical', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::CRITICAL)),
                      array('label' => 'Fehler', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::ERROR)),
                      array('label' => 'Warnungen', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::WARNING)),
                      array('label' => 'Info', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::INFO)),
                      array('label' => 'Einstellungen', 'page' => 'Admin_Page_Settings'),
                      array('label' => 'E-Mail Vorschau', 'page' => 'Admin_Page_EmailPreview'),
                  )),
        ));
    }
}
