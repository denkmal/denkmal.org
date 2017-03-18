<?php

class Denkmal_EventFormatter_GenresFilter extends CM_Usertext_Filter_Abstract {

    public function transform($text, CM_Frontend_Render $render) {
        $text = (string) $text;

        $placeholders = [];
        $wordBoundary = self::_getWordBoundaryPattern();
        foreach (self::_getGenreToColor() as $genre => $color) {
            if (false !== stripos($text, $genre)) {
                $pattern = '#' . $wordBoundary . '(' . preg_quote($genre, '#') . ')' . $wordBoundary . '#ui';
                $text = preg_replace_callback($pattern, function (array $matches) use (&$placeholders, $color) {
                    $placeholder = '{{{PLACEHOLDER-' . count($placeholders) . '}}}';
                    $placeholders[] = [
                        'search'  => $placeholder,
                        'replace' => '<span class="genre" style="background-image: linear-gradient(to top, ' . $color . ' 25%, transparent 25%);">' .
                            $matches[2] . '</span>',
                    ];
                    return $matches[1] . $placeholder . $matches[3];
                }, $text);
            }
        }

        foreach ($placeholders as $placeholder) {
            $text = str_replace($placeholder['search'], $placeholder['replace'], $text);
        }

        return $text;
    }

    public static function clearCache() {
        $cache = CM_Cache_Local::getInstance();
        $cache->delete(self::_getCacheKeyReplacements());
    }

    /**
     * @return array
     */
    private static function _getGenreToColor() {
        $cacheKey = self::_getCacheKeyReplacements();
        $cache = CM_Cache_Local::getInstance();

        return $cache->get($cacheKey, function () {
            $genreToColor = [];
            /** @var Denkmal_Model_EventCategory[] $categoryList */
            $categoryList = new Denkmal_Paging_EventCategory_All();
            foreach ($categoryList as $category) {
                foreach ($category->getGenreList() as $genre) {
                    $genreToColor[$genre] = '#' . $category->getColor()->getHexString();
                }
            }
            return $genreToColor;
        });
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
