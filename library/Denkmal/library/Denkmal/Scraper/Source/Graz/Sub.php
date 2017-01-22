<?php

class Denkmal_Scraper_Source_Graz_Sub extends Denkmal_Scraper_Source_Graz_Abstract {

    public function run(DateTime $now, array $dateList) {
        $url = 'http://www.subsubsub.at/daten.txt';
        $html = self::loadUrl($url);

        return $this->processPageDate($html, $now);
    }

    /**
     * @param string   $html
     * @param DateTime $now
     * @return Denkmal_Scraper_EventData[]
     */
    public function processPageDate($html, DateTime $now) {
        $document = new CM_Dom_NodeList($html, true);

        $itemList = $document->find('table.reihe');

        $eventDataList = Functional\map($itemList, function (CM_Dom_NodeList $item) use ($now) {
            $titleParts = Functional\map($item->find('.veranstalter'), function (CM_Dom_NodeList $node) {
                return $node->getText();
            });
            $titleParts = array_merge($titleParts, Functional\map($item->find('.vstitle'), function (CM_Dom_NodeList $node) {
                return $node->getText();
            }));
            $title = count($titleParts) > 0 ? join($titleParts, ' ') : null;

            $textParts = Functional\map($item->find('.bandData'), function (CM_Dom_NodeList $node) {
                return $node->getText();
            });
            $text = join($textParts, ', ');
            if (preg_match('#\d+Uhr: Plenum#', $text)) {
                return null;
            }

            $description = new Denkmal_Scraper_Description($text, $title);

            $date = $item->find('.dates')->getText();
            if (!preg_match('#^(\d+)\.(\d+)\.(\d+)$#', $date, $dateMatches)) {
                throw new CM_Exception_Invalid('Cannot parse date.', null, ['string' => $date]);
            }
            $from = new Denkmal_Scraper_Date($dateMatches[1], $dateMatches[2], $dateMatches[3], $now);
            $from->setTime(21);

            return new Denkmal_Scraper_EventData($this->getRegion(), 'SUb', $description, $from);
        });

        return array_values(array_filter($eventDataList));
    }
}
