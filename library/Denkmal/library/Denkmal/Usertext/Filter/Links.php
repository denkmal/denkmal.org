<?php

class Denkmal_Usertext_Filter_Links implements CM_Usertext_Filter_Interface {

    public function transform($text, CM_Render $render) {
        $text = (string) $text;
        foreach ($this->_getReplacements() as $replacement) {
            if (false === stripos($text, $replacement['label'])) {
                continue;
            }
            $text = preg_replace($replacement['search'], $replacement['replace'], $text);
        }
        return $text;
    }

    /**
     * @return array
     */
    private function _getReplacements() {
        $cacheKey = self::_getCacheKey();
        $cache = CM_Cache_Local::getInstance();
        if (($replacements = $cache->get($cacheKey)) === false) {
            $wordBoundary = '([^\w]|^|$)';
            $replacements = array();
            $linkList = new Denkmal_Paging_Link_All('label,url,automatic');
            foreach ($linkList->getItemsRaw() as $linkRow) {
                $label = CM_Util::htmlspecialchars($linkRow['label'], ENT_QUOTES);
                $url = (string) $linkRow['url'];
                $automatic = (bool) $linkRow['automatic'];
                if (!$automatic) {
                    $search = '#' . $wordBoundary . '\[' . preg_quote($label) . '\]' . $wordBoundary . '#ui';
                } else {
                    $search = '#' . $wordBoundary . preg_quote($label) . $wordBoundary . '#ui';
                }
                $replace = '$1<a href="' . $url . '" class="url" target="_blank">' . $label . '</a>$2';
                $replacements[] = array(
                    'label'   => $label,
                    'search'  => $search,
                    'replace' => $replace,
                );
            }
            $cache->set($cacheKey, $replacements);
        }
        return $replacements;
    }

    public static function clearCache() {
        $cacheKey = self::_getCacheKey();
        $cache = CM_Cache_Local::getInstance();
        $cache->delete($cacheKey);
    }

    /**
     * @return string
     */
    private static function _getCacheKey() {
        return 'Denkmal_Usertext_Filter_Links';
    }
}
