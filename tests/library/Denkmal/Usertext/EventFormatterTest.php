<?php

class Denkmal_Usertext_EventFormatterTest extends CMTest_TestCase {

    public function testConstruct() {
        $render = new CM_Frontend_Render();
        $eventFormatter = new Denkmal_Usertext_EventFormatter($render);
        Denkmal_Model_Link::create('foo', 'http://foo.com', true);

        $this->assertSame(
            'hello&lt;&gt; <a href="http://foo.com" class="url" target="_blank">foo</a> bar',
            $eventFormatter->transform('hello<> foo bar', $render));
    }
}
