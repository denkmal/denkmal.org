<?php

class Denkmal_Page_Events extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $date = $this->_params->getDate('date', Denkmal_Site::getCurrentDate());
        $dateList = new Denkmal_Paging_DateTime_Days();

        if (in_array($date, $dateList->getItems())) {
            $menu = new Denkmal_Menu_Weekdays();
        } else {
            $menu = new CM_Menu(array(array(
                'label'  => $date,
                'page'   => 'Denkmal_Page_Events',
                'params' => array('date' => $date->format('Y-n-j')),
            )));
        }
        $viewResponse->set('menu', $menu);
        $viewResponse->set('date', $date);
    }
}
