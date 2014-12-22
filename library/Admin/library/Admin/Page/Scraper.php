<?php

class Admin_Page_Scraper extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $scraperManager = new Denkmal_Scraper_Manager();
        $createdMin = (new DateTime())->sub(new DateInterval('P14D'));

        $graphSeriesEvents = $graphSeriesErrors = array();
        $resultErrorList = [];
        foreach ($scraperManager->getScraperList() as $scraper) {
            $dataEvents = $dataErrors = array();
            $resultList = new Denkmal_Paging_ScraperSourceResult_ScraperSource($scraper, $createdMin);
            /** @var Denkmal_Scraper_SourceResult $result */
            foreach ($resultList as $result) {
                $error = $result->getError();
                $dataEvents[$result->getCreated()->getTimestamp()] = $result->getEventDataCount();
                $dataErrors[$result->getCreated()->getTimestamp()] = (null !== $error);
                if (null !== $error) {
                    $resultErrorList[] = $result;
                }
            }

            $graphSeriesEvents[] = array('label' => $scraper->getName(), 'data' => $dataEvents);
            $graphSeriesErrors[] = array('label' => $scraper->getName(), 'data' => $dataErrors);
        }

        $viewResponse->set('graphSeriesEvents', $graphSeriesEvents);
        $viewResponse->set('graphSeriesErrors', $graphSeriesErrors);

        $viewResponse->set('errorFormatter', new CM_ExceptionHandling_Formatter_Plain());
        $viewResponse->set('resultErrorList', $resultErrorList);
    }
}
