<?php

class Denkmal_Scraper_Description {

    /** @var string|null */
    private $_title = null;

    /** @var string|null */
    private $_description = null;

    /** @var Denkmal_Scraper_Genres|null */
    private $_genres = null;

    /**
     * @param string|null                 $description Main event description
     * @param string|null                 $title       Event title
     * @param Denkmal_Scraper_Genres|null $genres      Event genres
     */
    public function __construct($description = null, $title = null, Denkmal_Scraper_Genres $genres = null) {
        if (null === $description) {
            $description = $title;
            $title = null;
        }
        if ($description) {
            $this->_description = $this->_parseString($description);
        }
        if ($title) {
            $this->_title = $this->_parseString($title);
        }
        $this->_genres = $genres;
    }

    /**
     * @return string|null
     */
    public function getTitle() {
        if (!$this->_title) {
            return null;
        }
        return ucfirst(substr($this->_title, 0, 80));
    }

    /**
     * @return string|null
     */
    public function getDescription() {
        if (!$this->_description) {
            return null;
        }
        return ucfirst(substr($this->_description, 0, 500));
    }

    /**
     * @return string
     */
    public function getTitleAndDescription() {
        $title = $this->getTitle();
        $description = $this->getDescription();

        $result = '';
        $result .= $title;
        if ($title && $description) {
            $result .= ': ';
        }
        $result .= $description;

        return $result;
    }

    /**
     * @return string|null
     */
    public function getGenres() {
        if (!$this->_genres || $this->_genres->count() === 0) {
            return null;
        }
        return substr($this->_genres->getString(), 0, 100);
    }

    /**
     * @param string $str
     * @return string
     */
    private function _parseString($str) {
        $str = strip_tags($str);
        $str = preg_replace('#\r?\n\r?#', ' ', $str);
        $str = strip_tags($str);
        $str = preg_replace('#\[(.+?)\]#', '($1)', $str);
        $str = preg_replace('#\bdj[\'`]s\b#', 'DJs', $str);
        $str = preg_replace('#[\:\.]$#', '', $str);
        $str = preg_replace_callback('#\b([A-ZÖÄÜ])([A-ZÖÄÜ]{2,})\b#', function ($matches) {
            return $matches[1] . strtolower($matches[2]);
        }, $str);
        $str = preg_replace('#\s+#u', ' ', $str);
        $str = preg_replace('#\bDJ[\'`‛’‘]?(s?)\b#i', 'DJ$1', $str);
        $str = trim($str);
        return $str;
    }
}
