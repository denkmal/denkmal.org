<?php

class Denkmal_Usertext_Filter_Links implements CM_Usertext_Filter_Interface {

	public function transform($text, CM_Render $render) {
		$text = (string) $text;
		$wordBoundary = '([^\w]|^|$)';
		/** @var $link Denkmal_Model_Link */
		foreach (new Denkmal_Paging_Link_All() as $link) {
			if (false === stripos($text, $link->getLabel())) {
				continue;
			}
			if (!$link->getAutomatic()) {
				$search = '#' . $wordBoundary . '\[' . preg_quote($link->getLabel()) . '\]' . $wordBoundary . '#ui';
			} else {
				$search = '#' . $wordBoundary . preg_quote($link->getLabel()) . $wordBoundary . '#ui';
			}
			$replace = '$1<a href="' . $link->getUrl() . '" class="url" target="_blank">' . $link->getLabel() . '</a>$3';
			$text = preg_replace($search, $replace, $text);
		}
		return $text;
	}
}
