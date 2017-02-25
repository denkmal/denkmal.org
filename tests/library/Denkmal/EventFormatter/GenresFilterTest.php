<?php

class Denkmal_EventFormatter_GenresFilterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testTransform() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFilter();

        $this->assertSame(
            'foo1, foo2, bar',
            $filter->transform('foo1, foo2, bar', $render));

        $eventCategory = Denkmal_Model_EventCategory::create('cat-foo', new CM_Color_RGB(255, 0, 0), ['foo1']);
        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)#FF0000([^"]*)">foo1</span>, foo2, bar|',
            $filter->transform('foo1, foo2, bar', $render));

        $eventCategory->addGenre('foo2');
        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)#FF0000([^"]*)">foo1</span>, <span class="genre" style="([^"]*)#FF0000([^"]*)">FOO2</span>, bar|',
            $filter->transform('foo1, FOO2, bar', $render));
    }

    public function testTransformContained() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFilter();

        Denkmal_Model_EventCategory::create('cat-punkrock', new CM_Color_RGB(0, 255, 0), ['punk rock']);
        Denkmal_Model_EventCategory::create('cat-rock', new CM_Color_RGB(255, 0, 0), ['rock']);

        $this->assertSame(
            '<span class="genre" style="background-color:#00FF00;">punk rock</span>',
            $filter->transform('punk rock', $render));

        $this->assertSame(
            '<span class="genre" style="background-color:#00FF00;">punk rock</span>, <span class="genre" style="background-color:#FF0000;">rock</span>',
            $filter->transform('punk rock, rock', $render));
    }
}
