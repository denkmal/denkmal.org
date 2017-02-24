<?php

class Denkmal_Menu_Main extends CM_Menu {

    public function __construct() {
        parent::__construct([
            [
                'label' => 'Calendar',
                'page'  => 'Denkmal_Page_Events',
                'class' => 'showWeek',
                'icon'  => 'calendar',
            ],
            [
                'label' => 'Add event',
                'page'  => 'Denkmal_Page_Add',
                'class' => 'addButton',
                'icon'  => 'plus',
            ],
        ]);
    }
}
