<?php

class Denkmal_Role {

	const ADMIN = 1;

	/**
	 * @return int[]
	 */
	public static function getRoles() {
		return array(self::ADMIN);
	}
}
