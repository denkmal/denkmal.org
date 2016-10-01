<?php

class Denkmal_Scraper_Source_Graz_Postgarage extends Denkmal_Scraper_Source_Graz_Abstract {

    public function run(array $dateList) {
        $url = 'http://www.postgarage.at/?id=27&type=100';
        $content = self::loadUrl($url);

        return $this->processPageDate($content);
    }

    /**
     * @param string        $xml
     * @param DateTime|null $now
     * @return Denkmal_Scraper_EventData[]
     */
    public function processPageDate($xml, DateTime $now = null) {
        $document = new CM_Dom_NodeList($xml, true);

        $itemList = $document->find('channel item');

        return Functional\map($itemList, function (CM_Dom_NodeList $item) use ($now) {
            $title = $item->find('title')->getText();
            $genres = new Denkmal_Scraper_Genres($item->find('description')->getText());
            $description = new Denkmal_Scraper_Description($title, null, $genres);

            $from = new DateTime($item->find('pubdate')->getText());

            return new Denkmal_Scraper_EventData($this->getRegion(), 'Postgarage', $description, $from);
        });
    }
}
