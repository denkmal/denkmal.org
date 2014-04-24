<?php

class Denkmal_Usertext_Filter_LinksTest extends CMTest_TestCase {

    public function testLinkChange() {
        $render = new CM_Render();
        $link = Denkmal_Model_Link::create('foo', 'http://foo.com', true);

        $filter = new Denkmal_Usertext_Filter_Links();
        $this->assertSame('hello <a href="http://foo.com" class="url" target="_blank">foo</a> bar', $filter->transform('hello foo bar', $render));

        $link->setLabel('bar');
        $filter = new Denkmal_Usertext_Filter_Links();
        $this->assertSame('hello foo <a href="http://foo.com" class="url" target="_blank">bar</a>', $filter->transform('hello foo bar', $render));
    }
}
