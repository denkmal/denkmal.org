<?php

class Denkmal_Scraper_Genres {

    /** @var string[] */
    private $_genreList = array();

    /**
     * @param string|string[] $genres
     */
    function __construct($genres) {
        if (!is_array($genres)) {
            $genres = Functional\map(preg_split('#[,|/]#', $genres), function ($genre) {
                return strtolower(trim($genre));
            });
        }
        $genres = array_filter($genres);
        $this->_genreList = $genres;
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->_genreList);
    }

    /**
     * @return string
     */
    public function __toString() {
        $genres = $this->_genreList;
        if (count($genres) > 0) {
            $genres[0] = ucfirst($genres[0]);
        }
        return implode(', ', $genres);
    }
}
