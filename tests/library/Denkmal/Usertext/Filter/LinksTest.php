<?php

class Denkmal_Usertext_Filter_LinksTest extends CMTest_TestCase {

    public function testLinkChange() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_Usertext_Filter_Links();

        $this->assertSame(
            'hello [hello] foo [bar] mega',
            $filter->transform('hello [hello] foo [bar] mega', $render));

        $linkFoo = Denkmal_Model_Link::create('foo', 'http://foo.com', true);
        $linkBar = Denkmal_Model_Link::create('bar', 'http://bar.com', false);

        $this->assertSame(
            'hello [hello] <a href="http://foo.com" class="url" target="_blank">foo</a> <a href="http://bar.com" class="url" target="_blank">bar</a> mega',
            $filter->transform('hello [hello] foo [bar] mega', $render));

        $linkFoo->setLabel('mega');
        $linkBar->setAutomatic(true);
        $filter = new Denkmal_Usertext_Filter_Links();
        $this->assertSame(
            'hello [hello] foo <a href="http://bar.com" class="url" target="_blank">bar</a> <a href="http://foo.com" class="url" target="_blank">mega</a>',
            $filter->transform('hello [hello] foo [bar] mega', $render));
    }
}
