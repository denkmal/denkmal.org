<?php

class Admin_LinkCheck_Cli extends CM_Cli_Runnable_Abstract {

	public function run() {
		$linkList = new Denkmal_Paging_Link_All();
		foreach ($linkList as $link) {
			/** @var Denkmal_Model_Link $link */
			try {
				CM_Util::getContents($link->getUrl());
			} catch (CM_Exception_Invalid $ex) {
				$link->setFailedCount($link->getFailedCount()+1);
			}
		}
	}

	public static function getPackageName() {
		return 'link-check';
	}
}
