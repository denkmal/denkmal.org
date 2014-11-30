<?php

class Denkmal_Scraper_Source_Saali extends Denkmal_Scraper_Source_Abstract {

    public function run() {
        $html = self::loadUrl('http://www.goldenes-fass.ch/saali/');

        $this->processPage($html);
    }

    /**
     * @param string   $html
     * @param int|null $year
     */
    public function processPage($html, $year = null) {
        $html = new CM_Dom_NodeList($html, true);
        $venueName = 'Sääli';

        $textList = Functional\map($html->find('.content > *'), function (CM_Dom_NodeList $contentChild) {
            return $contentChild->getText();
        });

        $textSeparatorIndex = $this->_getFirstIndexOf($textList, function ($text) {
            return preg_match('#Live:#', $text);
        });
        $textList = array_splice($textList, $textSeparatorIndex + 1);

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

        foreach ($eventListTextList as $eventTextList) {
            if (count($eventTextList) < 2) {
                throw new CM_Exception_Invalid('Unexpected eventTextList: `' . CM_Util::var_line($eventTextList) . '`.');
            }

            if (!preg_match('#^\w{2}_(\d+)\.(\d+)\.?\s+(.+)$#', $eventTextList[0], $matches0)) {
                throw new CM_Exception_Invalid('Cannot parse event line: `' . $eventTextList[0] . '`.');
            }
            $from = new Denkmal_Scraper_Date($matches0[1], $matches0[2], $year);
            $descriptionList = array($matches0[3]);

            if (!preg_match('#^(\d+)\.(\d+)h\s+(.+)?$#', $eventTextList[1], $matches1)) {
                throw new CM_Exception_Invalid('Cannot parse event line: `' . $eventTextList[1] . '`.');
            }
            $from->setTime($matches1[1], $matches1[2]);
            if (isset($matches1[3])) {
                $descriptionList[] = $matches1[3];
            }

            $descriptionList = array_merge($descriptionList, array_splice($eventTextList, 2));
            $description = new Denkmal_Scraper_Description(implode(' ', $descriptionList));

            $this->_addEventAndVenue(
                $venueName,
                $description,
                $from->getDateTime()
            );
        }
    }

    /**
     * @param array    $array
     * @param callable $callback
     * @return mixed
     * @throws CM_Exception
     */
    private function _getFirstIndexOf(array $array, callable $callback) {
        foreach ($array as $index => $value) {
            if (call_user_func($callback, $value)) {
                return $index;
            }
        }
        throw new CM_Exception('Cannot find first index in array.');
    }
}
