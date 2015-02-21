<?php

class Denkmal_SiteTest extends CMTest_TestCase {

    public function testEmoticonValidity() {
        CM_Emoticon::validateData();
    }
}
