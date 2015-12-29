<?php

class Denkmal_Scraper_Source_Programmzeitung extends Denkmal_Scraper_Source_Abstract {

    public function run(Denkmal_Scraper_Manager $manager) {
        return Functional\flatten(Functional\map($manager->getDateList(), function (DateTime $date) {
            $dateStr = $date->format('d.m.Y');
            $url = 'http://programmzeitung.programmonline.ch/Content/Tagesagenda?startDate=' . $dateStr;
            $content = self::loadUrl($url, 5);

            return $this->processPageDate($content, $date);
        }));
    }

    /**
     * @param string   $html
     * @param DateTime $date
     * @throws CM_Exception_Invalid
     * @return Denkmal_Scraper_EventData[]
     */
    public function processPageDate($html, DateTime $date) {
        $html = new CM_Dom_NodeList($html, true);

        /** @var CM_Dom_NodeList[] $agendaTableList */
        $agendaTableList = [];
        foreach ($html->find('.tagesagenda > .category') as $i => $category) {
            $title = $category->find('> h2')->getText();
            $table = $category->find('> table');
            $agendaTableList[$title] = $table;
        }

        if (empty($agendaTableList)) {
            throw new CM_Exception_Invalid('Cannot detect event tables', ['html' => $html->getHtml()]);
        }

        $categoryList = [
            'Musik, Konzerte',
            'Sounds & Floors',
        ];

        $eventDataList = [];
        foreach ($categoryList as $category) {
            if (isset($agendaTableList[$category])) {
                $eventDataList = array_merge($eventDataList, $this->_parseCategory($agendaTableList[$category], $date));
            }
        }
        return $eventDataList;
    }

    /**
     * @param CM_Dom_NodeList $agendaTable
     * @param DateTime        $date
     * @return Denkmal_Scraper_EventData[]
     */
    private function _parseCategory(CM_Dom_NodeList $agendaTable, $date) {
        return Functional\map($agendaTable->find('tr'), function (CM_Dom_NodeList $agendaTableRow) use ($date) {
            $agendaTableCell = $agendaTableRow->find('td');
            if (3 != count($agendaTableCell)) {
                throw new CM_Exception_Invalid('Unexpected row count.', ['html' => $agendaTableRow->getHtml()]);
            }
            $timeNode = $agendaTableCell[0];
            $descriptionNode = $agendaTableCell[1];
            $venueNode = $agendaTableCell[2];

            $timeTextList = explode('<br>', $timeNode->getChildren()->getHtml());
            $timeText = trim($timeTextList[0]);
            $from = new Denkmal_Scraper_Date($date);
            if (0 === strlen($timeText)) {
                $from->setTime(21, 00);
            } elseif (preg_match('#^(\d+):(\d+)(\s+.\s+(\d+):(\d+))?$#u', $timeText, $matches)) {
                $from->setTime($matches[1], $matches[2]);
            } else {
                throw new CM_Exception_Invalid('Cannot detect time from `' . $timeText . '`.');
            }
            $until = null;
            if (isset($matches[4]) && isset($matches[5])) {
                $until = clone $from;
                $until->setTime($matches[4], $matches[5]);
            }

            $description = new Denkmal_Scraper_Description(
                $this->_cleanupText($descriptionNode->getChildren(XML_TEXT_NODE)->getText()),
                $this->_cleanupText($descriptionNode->find('b')->getText())
            );

            $venueText = $venueNode->find('.veranstaltungsOrt')->getText();
            $venueText = preg_replace('#,.*?$#u', '', $venueText);
            $venueText = preg_replace('#\[.+?\].*$#u', '', $venueText);
            $venueText = preg_replace('#♦.*$#u', '', $venueText);
            $venueText = trim($venueText);

            return new Denkmal_Scraper_EventData($venueText, $description, $from, $until);
        });
    }

    /**
     * @param string $text
     * @return string
     */
    private function _cleanupText($text) {
        $text = str_replace('♦', '-', $text);
        return $text;
    }
}
