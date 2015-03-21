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
                      array('label' => 'Fehler', 'page' => 'Admin_Page_Log', 'params' => array('type' => CM_Paging_Log_Error::getTypeStatic())),
                      array('label' => 'Warnungen', 'page' => 'Admin_Page_Log', 'params' => array('type' => CM_Paging_Log_Warn::getTypeStatic())),
                      array('label' => '404', 'page' => 'Admin_Page_Log', 'params' => array('type' => CM_Paging_Log_NotFound::getTypeStatic())),
                      array('label' => 'JS Fehler', 'page' => 'Admin_Page_Log', 'params' => array('type' => CM_Paging_Log_JsError::getTypeStatic())),
                      array('label' => 'Einstellungen', 'page' => 'Admin_Page_Settings'),
                      array('label' => 'E-Mail Vorschau', 'page' => 'Admin_Page_EmailPreview'),
                  )),
        ));
    }
}
