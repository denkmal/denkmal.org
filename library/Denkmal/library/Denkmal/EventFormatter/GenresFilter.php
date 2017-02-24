<?php

class Denkmal_EventFormatter_GenresFilter extends CM_Usertext_Filter_Abstract {

    public function transform($text, CM_Frontend_Render $render) {
        if (!CM_Bootloader::getInstance()->isDebug()) {
            // @todo remove to enable once frontend is ready
            return $text;
        }

        $text = (string) $text;
        foreach (self::getReplacements() as $replacement) {
            if (false === stripos($text, $replacement['genre'])) {
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
            $replacements = [];
            $wordBoundary = self::_getWordBoundaryPattern();

            /** @var Denkmal_Model_EventCategory[] $categoryList */
            $categoryList = new Denkmal_Paging_EventCategory_All();
            foreach ($categoryList as $category) {
                foreach ($category->getGenreList() as $genre) {
                    $search = '#' . $wordBoundary . '(' . preg_quote($genre, '#') . ')' . $wordBoundary . '#ui';
                    $replace = '$1<span class="genre" style="background-color:#' . $category->getColor()->getHexString() . ';">$2</span>$3';
                    $replacements[] = array(
                        'genre'   => $genre,
                        'search'  => $search,
                        'replace' => $replace,
                    );
                }
            }
            $cache->set($cacheKey, $replacements);
        }
        return $replacements;
    }

    public static function clearCache() {
        $cache = CM_Cache_Local::getInstance();
        $cache->delete(self::_getCacheKeyReplacements());
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
        return __CLASS__ . ':replacements';
    }

}
