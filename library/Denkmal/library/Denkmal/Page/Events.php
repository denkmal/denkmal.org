<?php

class Denkmal_Page_Events extends Denkmal_Page_Abstract {

    public function prepare() {
        $date = $this->_params->getDate('date');
        $dateList = new Denkmal_Paging_DateTime_Days();

        if (in_array($date, $dateList->getItems())) {
            $menu = new Denkmal_Menu_Weekdays();
        } else {
            $menu = new CM_Menu(array(array(
                'label'  => $date,
                'page'   => 'Denkmal_Page_Events',
                'params' => array('date' => $date->format('Y-n-j')),
            )));
            $this->_setJsParam('_stateParams', null);
        }
        $this->setTplParam('menu', $menu);
        $this->setTplParam('date', $date);
    }
}
