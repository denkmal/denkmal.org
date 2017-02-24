<?php

class Denkmal_EventFormatter_GenresFilterTest extends CMTest_TestCase {

    public function testLinkChange() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFilter();

        $this->assertSame(
            'foo1, foo2, bar',
            $filter->transform('foo1, foo2, bar', $render));

        $eventCategory = Denkmal_Model_EventCategory::create('cat-foo', new CM_Color_RGB(255, 0, 0), ['foo1']);
        $this->assertSame(
            '<span class="genre" style="background-color:#FF0000;">foo1</span>, foo2, bar',
            $filter->transform('foo1, foo2, bar', $render));

        $eventCategory->addGenre('foo2');
        $this->assertSame(
            '<span class="genre" style="background-color:#FF0000;">foo1</span>, <span class="genre" style="background-color:#FF0000;">FOO2</span>, bar',
            $filter->transform('foo1, FOO2, bar', $render));
    }
}
