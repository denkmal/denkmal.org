<?php

class Denkmal_FormField_Venue extends CM_FormField_SuggestOne {

	public function __construct() {
		parent::__construct(true);
	}

	public function validate($userInput, CM_Response_Abstract $response) {
		$userInput = parent::validate($userInput, $response);
		if (is_numeric($userInput)) {
			$userInput = new Denkmal_Model_Venue($userInput);
		}
		return $userInput;
	}

	public function getSuggestion($item, CM_Render $render) {
		return array('id' => $item->getId(), 'name' => $item->getName());
	}

	protected function _getSuggestions($term, array $options, CM_Render $render) {
		$term = (string) $term;
		$suggestions = array();
		/** @var $item Denkmal_Model_Venue */
		foreach (new Denkmal_Paging_Venue_All() as $item) {
			if (0 === stripos($item->getName(), $term)) {
				$suggestions[] = $this->getSuggestion($item, $render);
			}
		}
		return $suggestions;
	}
}
