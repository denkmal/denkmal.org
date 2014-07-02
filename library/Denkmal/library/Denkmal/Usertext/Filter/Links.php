<?php

class Denkmal_Usertext_Filter_Links extends CM_Usertext_Filter_Abstract {

    public function transform($text, CM_Frontend_Render $render) {
        $text = (string) $text;
        foreach (self::getReplacements() as $replacement) {
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
    public static function getReplacements() {
        $cacheKey = self::_getCacheKeyReplacements();
        $cache = CM_Cache_Local::getInstance();
        if (($replacements = $cache->get($cacheKey)) === false) {
            $replacements = array();
            $linkList = new Denkmal_Paging_Link_All('label,url,automatic');
            foreach ($linkList->getItemsRaw() as $linkRow) {
                $label = CM_Util::htmlspecialchars($linkRow['label'], ENT_QUOTES);
                $url = (string) $linkRow['url'];
                $automatic = (bool) $linkRow['automatic'];
                if (!$automatic) {
                    $search = '#' . self::_getWordBoundaryPattern() . '\[' . preg_quote($label, '#') . '\]' . self::_getWordBoundaryPattern() . '#ui';
                } else {
                    $search = '#' . self::_getWordBoundaryPattern() . preg_quote($label, '#') . self::_getWordBoundaryPattern() . '#ui';
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

    /**
     * @return array
     */
    public static function getSearchesForManualSuggestions() {
        $cacheKey = self::_getCacheKeyManualSuggestions();
        $cache = CM_Cache_Local::getInstance();
        if (($searches = $cache->get($cacheKey)) === false) {
            $searches = array();
            $linkList = new Denkmal_Paging_Link_Manual('id,label,url');
            foreach ($linkList->getItemsRaw() as $linkRow) {
                $label = CM_Util::htmlspecialchars($linkRow['label'], ENT_QUOTES);
                $id = (int) $linkRow['id'];
                $search = '#' . self::_getWordBoundaryPattern('\[') . preg_quote($label, '#') . self::_getWordBoundaryPattern('\]') . '#ui';
                $searches[] = array(
                    'label'  => $label,
                    'search' => $search,
                    'id'     => $id,
                );
            }
            $cache->set($cacheKey, $searches);
        }
        return $searches;
    }

    public static function clearCache() {
        $cache = CM_Cache_Local::getInstance();
        $cache->delete(self::_getCacheKeyReplacements());
        $cache->delete(self::_getCacheKeyManualSuggestions());
    }

    /**
     * @param string|null $exclude
     * @return string
     */
    private static function _getWordBoundaryPattern($exclude = null) {
        return '([^\w' . $exclude . ']|^|$)';
    }

    /**
     * @return string
     */
    private static function _getCacheKeyReplacements() {
        return 'Denkmal_Usertext_Filter_Links:replacements';
    }

    /**
     * @return string
     */
    private static function _getCacheKeyManualSuggestions() {
        return 'Denkmal_Usertext_Filter_Links:manualSuggestions';
    }
}
