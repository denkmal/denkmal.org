<?php

class Denkmal_FormField_Venue extends CM_FormField_SuggestOne {

	/** @var boolean */
	private $_onlyPublic = true;

	/**
	 * @param $onlyPublic
	 */
	public function setOnlyPublic($onlyPublic) {
		$this->_onlyPublic = (bool) $onlyPublic;
	}

	public function validate($userInput, CM_Response_Abstract $response) {
		$userInput = parent::validate($userInput, $response);
		return new Denkmal_Model_Venue($userInput);
	}

	public function getSuggestion($item, CM_Render $render) {
		return array('id' => $item->getId(), 'name' => $item->getName());
	}

	protected function _getSuggestions($term, array $options, CM_Render $render) {
		$term = (string) $term;
		$suggestions = array();
		/** @var $item Denkmal_Model_Venue */
		foreach ($this->_getPaging() as $item) {
			if (0 === stripos($item->getName(), $term)) {
				$suggestions[] = $this->getSuggestion($item, $render);
			}
		}
		return $suggestions;
	}

	/**
	 * @return Denkmal_Paging_Venue_Abstract
	 */
	private function _getPaging() {
		if ($this->_onlyPublic) {
			return new Denkmal_Paging_Venue_Public();
		}
		return new Denkmal_Paging_Venue_All();
	}

}
