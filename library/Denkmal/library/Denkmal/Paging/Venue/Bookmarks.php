<?php

class Denkmal_Paging_Venue_Bookmarks extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param string|null $cookieValue
     */
    public function __construct($cookieValue = null) {
        $cookieValue = (string) $cookieValue;
        $venueIdList = [];
        if (strlen($cookieValue) > 0) {
            try {
                $venueIdList = CM_Util::jsonDecode($cookieValue);
                $venueIdList = Functional\map($venueIdList, function ($venueId) {
                    return (int) $venueId;
                });
            } catch (CM_Exception $e) {
                $context = new CM_Log_Context();
                $context->setException($e);
                $logger = CM_Service_Manager::getInstance()->getLogger();
                $logger->warning('Cannot decode venue-bookmarks cookie', $context);
                $venueIdList = [];
            }
        }

        if (0 === count($venueIdList)) {
            $source = new CM_PagingSource_Array([]);
        } else {
            $where = 'id IN(' . join(',', $venueIdList) . ')';
            $source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where, 'LOWER(`name`)');
            $source->enableCache();
        }

        parent::__construct($source);
    }

}
