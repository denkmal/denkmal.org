<?php

class Admin_Page_EventCategories extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $eventCategoryList = new Denkmal_Paging_EventCategory_All();

        $viewResponse->set('eventCategoryList', $eventCategoryList);
    }

}
