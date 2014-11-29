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

        print_r($textList);
        return;
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
