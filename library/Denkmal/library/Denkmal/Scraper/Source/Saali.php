<?php

class Denkmal_Scraper_Source_Saali extends Denkmal_Scraper_Source_Abstract {

    public function run(Denkmal_Scraper_Manager $manager) {
        $html = self::loadUrl('http://www.goldenes-fass.ch/saali/');

        return $this->processPage($html);
    }

    /**
     * @param string   $html
     * @param int|null $forceYear
     * @return Denkmal_Scraper_EventData[]
     * @throws CM_Exception
     */
    public function processPage($html, $forceYear = null) {
        $html = new CM_Dom_NodeList($html, true);

        $textList = Functional\map($html->find('.content > *'), function (CM_Dom_NodeList $contentChild) {
            return $contentChild->getText();
        });

        if (Functional\some($textList, function ($text) {
            return strtolower($text) === 'sommerpause:';
        })) {
            return [];
        }

        $textList = Functional\reject($textList, function ($text) {
            return preg_match('#\w+ \(?pdf\)?#i', $text);
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

        $eventDataList = Functional\map($eventListTextList, function ($eventTextList) use ($forceYear) {
            if (count($eventTextList) < 2) {
                throw new CM_Exception_Invalid('Unexpected eventTextList: `' . CM_Util::var_line($eventTextList) . '`.');
            }

            // Parse first line
            if (!preg_match('#^\w{2}[_\s]+(\d+)\.(\d+)\.?\s+(.+)$#', $eventTextList[0], $matches0)) {
                throw new CM_Exception_Invalid('Cannot parse event line: `' . $eventTextList[0] . '`.');
            }
            $from = new Denkmal_Scraper_Date($matches0[1], $matches0[2], $forceYear);
            $descriptionList = array($matches0[3]);

            // Parse second line
            if (preg_match('#^(\d+)\.(\d+)h\s+(.+)?$#', $eventTextList[1], $matches1)) {
                $from->setTime($matches1[1], $matches1[2]);
                if (isset($matches1[3])) {
                    $descriptionList[] = $matches1[3];
                }
            } else {
                $from->setTime(21);
                $descriptionList[] = $eventTextList[1];
            }

            // Take the rest
            $descriptionList = array_merge($descriptionList, array_splice($eventTextList, 2));
            $description = new Denkmal_Scraper_Description(implode(' ', $descriptionList));

            return new Denkmal_Scraper_EventData('Sääli', $description, $from);
        });

        return array_values($eventDataList);
    }
}
