<?php

class Denkmal_Scraper_Genres {

	/** @var string[] */
	private $_genres = array();

	/**
	 * @param string $genres Genres list as string
	 */
	function __construct($genres) {
		$genres = new Denkmal_Scraper_String($genres);
		foreach ($genres->split('#[,|/]#') as $genre) {
			if ($genre = strtolower(trim($genre))) {
				$this->_genres[] = $genre;
			}
		}
	}

	/**
	 * @return int
	 */
	public function count() {
		return count($this->_genres);
	}

	/**
	 * @return string
	 */
	public function __toString() {
		$genres = $this->_genres;
		if (count($genres) > 0) {
			$genres[0] = ucfirst($genres[0]);
		}
		return implode(', ', $genres);
	}
}
