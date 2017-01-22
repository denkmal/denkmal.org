<?php

class Denkmal_Scraper_Source_Apawi extends Denkmal_Scraper_Source_Abstract {

    public function run(DateTime $now, array $dateList) {
        $url = 'http://apawi.ch/events/feed';
        $content = self::loadUrl($url);

        return $this->processPageDate($content, $now);
    }

    /**
     * @param string   $xml
     * @param DateTime $now
     * @return Denkmal_Scraper_EventData[]
     */
    public function processPageDate($xml, DateTime $now) {
        $document = new CM_Dom_NodeList($xml, true);

        $itemList = $document->find('channel item');

        return Functional\map($itemList, function (CM_Dom_NodeList $item) use ($now) {
            $from = new DateTime($item->find('startdate')->getText());
            $until = new DateTime($item->find('enddate')->getText());

            $title = $item->find('title')->getText();
            $category = $item->find('category')->getText();
            $description = new Denkmal_Scraper_Description($title, null, new Denkmal_Scraper_Genres($category));

            return new Denkmal_Scraper_EventData($this->getRegion(), 'Apawi', $description, $from, $until);
        });
    }

    public function getRegion() {
        return Denkmal_Model_Region::getBySlug('basel');
    }
}
