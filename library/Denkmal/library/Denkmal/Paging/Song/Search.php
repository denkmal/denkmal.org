<?php

class Denkmal_Paging_Song_Search extends Denkmal_Paging_Song_Abstract {

	/**
	 * @param string $term
	 */
	public function __construct($term) {
		$term = (string) $term;
		$source = new CM_PagingSource_Sql('id', 'denkmal_model_song', '`label` LIKE ?', '`label`', null, null, array('%' . $term . '%'));
		parent::__construct($source);
	}
}
