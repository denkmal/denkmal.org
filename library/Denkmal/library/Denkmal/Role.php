<?php

class Denkmal_Role {

    const ADMIN = 1;
    const PUBLISHER = 2;

    /**
     * @return int[]
     */
    public static function getRoles() {
        return [
            self::ADMIN,
            self::PUBLISHER,
        ];
    }
}
