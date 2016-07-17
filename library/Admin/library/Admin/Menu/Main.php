<?php
class Admin_Menu_Main extends CM_Menu {
    public function __construct() {
        parent::__construct(array(
            array('label' => 'Events', 'page' => 'Admin_Page_Events'),
            array('label' => 'Venues', 'page' => 'Admin_Page_Venues'),
            array('label' => 'Links', 'page' => 'Admin_Page_Links'),
            array('label' => 'Songs', 'page' => 'Admin_Page_Songs'),
            array('label'   => 'More…', 'page' => 'Admin_Page_Scraper',
                  'submenu' => array(
                      array('label' => 'Scraper', 'page' => 'Admin_Page_Scraper'),
                      array('label' => 'Translations', 'page' => 'Admin_Page_Translations'),
                      array('label' => 'Users', 'page' => 'Admin_Page_Users'),
                      array('label' => 'Invites', 'page' => 'Admin_Page_UserInvites'),
                      array('label'   => 'Logs', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::CRITICAL),
                            'submenu' => array(
                                array('label' => 'Critical', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::CRITICAL)),
                                array('label' => 'Errors', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::ERROR)),
                                array('label' => 'Warnings', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::WARNING)),
                                array('label' => 'Info', 'page' => 'Admin_Page_Log', 'params' => array('level' => CM_Log_Logger::INFO)),
                            ),
                      ),
                      array('label' => 'Settings', 'page' => 'Admin_Page_Settings'),
                      array('label' => 'Email Preview', 'page' => 'Admin_Page_EmailPreview'),
                  )),
        ));
    }
}
