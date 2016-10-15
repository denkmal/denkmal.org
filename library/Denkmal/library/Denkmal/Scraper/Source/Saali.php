<?php

class Denkmal_Scraper_Source_Saali extends Denkmal_Scraper_Source_Abstract {

    public function run(array $dateList) {
        $html = self::loadUrl('http://www.goldenes-fass.ch/saali/');

        return $this->processPage($html);
    }

    /**
     * @param string        $html
     * @param DateTime|null $now
     * @return Denkmal_Scraper_EventData[]
     * @throws CM_Exception
     */
    public function processPage($html, DateTime $now = null) {
        $html = new CM_Dom_NodeList($html, true);

        $textList = Functional\map($html->find('.content > *'), function (CM_Dom_NodeList $contentChild) {
            return $contentChild->getText();
        });

        if (Functional\some($textList, function ($text) {
            return strtolower($text) === 'sommerpause:';
        })) {
            return [];
        }

        $textIgnoreList = [
            '#\w+ \(?pdf\)?#i',
            '#FÜR MEHR INFOS#i',
            '#Saisonstart#i',
            '#PROGRAMM (\w+) 20\d{2}#i',
        ];
        $textList = Functional\reject($textList, function ($text) use ($textIgnoreList) {
            return Functional\some($textIgnoreList, function ($textIgnorePattern) use ($text) {
                return 1 === preg_match($textIgnorePattern, $text);
            });
        });

        $textList = Functional\reject(array_values($textList), function ($text, $index, $textList) {
            if (0 === $index || count($textList) - 1 === $index) {
                return false;
            }
            $textPrevious = $textList[$index - 1];
            $textNext = $textList[$index + 1];
            $previousAndNextEmpty = preg_match('#^\s*$#', $textPrevious) && preg_match('#^\s*$#', $textNext);
            return $previousAndNextEmpty;
        });

        $eventListTextList = array();
        $eventIndex = 0;
        foreach ($textList as $text) {
            $text = trim($text);
            if ('' === $text) {
                $eventIndex++;
            } else {
                $eventListTextList[$eventIndex][] = $text;
            }
        }
        $eventListTextList = array_filter($eventListTextList);

        $eventDataList = Functional\map($eventListTextList, function ($eventTextList) use ($now) {
            if (count($eventTextList) < 2) {
                throw new CM_Exception_Invalid('Unexpected eventTextList: `' . CM_Util::var_line($eventTextList) . '`.');
            }
            $title = null;
            $descriptionList = [];

            // Parse first line
            if (!preg_match('#^\w{2}[_\s]+(\d+)\.(\d+)\.?[_\s]+(.+)$#', $eventTextList[0], $matches0)) {
                throw new CM_Exception_Invalid('Cannot parse event line.', null, ['string' => $eventTextList[0]]);
            }
            $from = new Denkmal_Scraper_Date($matches0[1], $matches0[2], null, $now);
            $from->setTime(21);
            // Parse first line extra
            if (preg_match('#^(?<hour>\d+)(?:\.(?<minute>\d+))?h(?:[_\s]+(?<title>.+)?)?$#', $matches0[3], $matches0extra)) {
                if (!empty($matches0extra['title'])) {
                    $title = $matches0extra['title'];
                }
                if (!empty($matches0extra['minute'])) {
                    $from->setTime($matches0extra['hour'], $matches0extra['minute']);
                } else {
                    $from->setTime($matches0extra['hour']);
                }
            } else {
                $descriptionList[] = $matches0[3];
            }

            // Parse second line
            if (preg_match('#^(\d+)\.(\d+)h\s+(.+)?$#', $eventTextList[1], $matches1)) {
                $from->setTime($matches1[1], $matches1[2]);
                if (isset($matches1[3])) {
                    $descriptionList[] = $matches1[3];
                }
            } else {
                $descriptionList[] = $eventTextList[1];
            }

            // Take the rest
            $descriptionList = array_merge($descriptionList, array_splice($eventTextList, 2));
            $description = new Denkmal_Scraper_Description(implode(' ', $descriptionList), $title);

            return new Denkmal_Scraper_EventData($this->getRegion(), 'Sääli', $description, $from);
        });

        return array_values($eventDataList);
    }

    public function getRegion() {
        return Denkmal_Model_Region::getBySlug('basel');
    }
}
